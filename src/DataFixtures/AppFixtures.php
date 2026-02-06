<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\User;
use App\Entity\Comment;
use App\Enums\UserRoles;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{


    public function load(ObjectManager $manager): void
    {
        $date = new \DateTimeImmutable();

        /** ---------- CATEGORIES ---------- */
        foreach (DataFixtures::CATEGORIES as $i => $data) {
            $category = (new Category())
                ->setName($data['name'])
                ->setDescription($data['description']);

            $manager->persist($category);
            $this->addReference("category_$i", $category);
        }

        /** ---------- USERS ---------- */
        foreach (DataFixtures::USERS as $i => $data) {
            $user = (new User())
                ->setEmail($data['email'])
                ->setPassword(password_hash($data['password'], PASSWORD_BCRYPT)) //  hash BCRYPT
                ->setFirstName($data['firstName'])
                ->setLastName($data['lastName'])
                ->setRoles($data['role'])
                ->setProfilePicture($data['profilePicture'])
                ->setCreatedAt($date)
                ->setUpdatedAt($date);

            if($data['activated'] ){
                    $user->setActivated($data['activated']);
            }
            $manager->persist($user);
            $this->addReference("user_$i", $user);

            if ($data['role'] === UserRoles::ADMIN) {
                $this->addReference('admin_user', $user);
            }
        }

        /** ---------- POSTS ---------- */
        foreach (DataFixtures::POSTS as $i => $data) {
            $category = $this->getReference(
                'category_' . $data['categoryIndex'],
                Category::class
            );

            $post = (new Post())
                ->setTitle($data['title'])
                ->setSlug($data['slug'])
                ->setContent($data['content'])
                ->setPicture($data['picture'])

                ->setIsPublished(true)
                ->setUser($this->getReference('admin_user', User::class))
                ->setCreatedAt($date)
                ->setUpdatedAt($date);
            
            if($data['categoryIndex'] ){
                    $post->setCategory($this->getReference( "category_".$data['categoryIndex'],Category::class));
            }


            // relation métier : Category -> Posts
            $category->addPost($post);

            $manager->persist($post);
            $this->addReference("post_$i", $post);
        }

        /** ---------- COMMENTS ---------- */
        foreach (DataFixtures::COMMENTS as $data) {
            $comment = (new Comment())
                ->setContent($data['content'])
                ->setStatus($data['status'])
                ->setUser($this->getReference('user_' . $data['userIndex'], User::class))
                ->setPost($this->getReference('post_' . $data['postIndex'], Post::class))
                ->setCreatedAt($date);

            $manager->persist($comment);
        }

        $manager->flush();
    }
}
