<?php

namespace App\Controller\Posts\Pages;

use App\Entity\Category;
use App\Entity\Post;

use App\Form\CategoryType;
use App\Form\PostType;

use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use App\Enums\UserRoles;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class AdminPageViewController extends AbstractController
{

    public function __construct(
        private PostRepository $postRepository,
        private UserRepository $userRepository,
        private CategoryRepository $categoryRepository,
        private CommentRepository $commentRepository,
        private EntityManagerInterface $em,
    )
    {}


    #[Route('/posts/add', methods: ['GET', 'POST'], name: 'page_post_add')]
    public function addPost(Request $request)
    {
        
        $post = new Post();
        $postForm = $this->createForm(PostType::class, $post);

        $category = new Category();
        $categoryForm = $this->createForm(CategoryType::class, $category);

        $categories = $this->categoryRepository->findAll();

        $postForm->handleRequest($request);
        $categoryForm->handleRequest($request);

        // --- POST FORM ---
        if ($postForm->isSubmitted() && $postForm->isValid()) {
            $now = new \DateTimeImmutable();
            $post->setCreatedAt($now);
            $post->setUpdatedAt($now);
            $post->setUser($this->getUser());

            $this->em->persist($post);
            $this->em->flush();

            return $this->redirectToRoute('posts_management'); // <-- vérifier la bonne route
        }

        // --- CATEGORY FORM ---
        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
            $this->em->persist($category);
            $this->em->flush();

            return $this->redirectToRoute('page_post_add'); 
        }

        return $this->render('posts/admin/add.edit.post.catgory.html.twig', [
            'categories' => $categories,
            'postForm' => $postForm->createView(),
            'categoryForm' => $categoryForm->createView(),
            'role' => UserRoles::ADMIN->value,
            'selectedCategory' => null
        ]);
    }

    #[Route('/posts/edit/{id}', name: 'page_post_edit')]
    public function editPost(Request $request, int $id)
    {
        $post = $this->postRepository->find($id);
        if (!$post) {
            return $this->redirectToRoute('posts_management');
        }

        $postForm = $this->createForm(PostType::class, $post);
        $categoryForm = $this->createForm(CategoryType::class, new Category());
        $categories = $this->categoryRepository->findAll();

        $postForm->handleRequest($request);
        $categoryForm->handleRequest($request);

        if ($postForm->isSubmitted() && $postForm->isValid()) {
            $post->setUpdatedAt(new \DateTimeImmutable());
            $this->em->flush();

            return $this->redirectToRoute('posts_management');
        }

        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
            $this->em->persist($categoryForm->getData());
            $this->em->flush();

            return $this->redirectToRoute('page_post_edit', ['id' => $id]);
        }

        return $this->render('posts/admin/add.edit.post.catgory.html.twig', [
            'categories' => $categories,
            'postForm' => $postForm->createView(),
            'categoryForm' => $categoryForm->createView(),
            'selectedCategory' => $post->getCategory(),
            'role' => UserRoles::ADMIN->value
        ]);
    }




    #[Route("/posts/management", methods: ['GET'], name: "posts_management")]
    public function postBoard()
    {

        $posts = $this->postRepository->findAll();
        return $this->render(
            "posts/admin/post.management.html.twig",
            ['posts' => $posts, "role" => UserRoles::ADMIN->value ]
        );
    }


    #[Route("/comments/managements", methods: ['GET'], name: "comment_management")]
    public function manageComments()
    {
        $comments = $this->commentRepository->findAll();
        return $this->render(
            "posts/admin/comment.management.html.twig",
            ["comments" => $comments, "role" => UserRoles::ADMIN->value]
        );
    }
    


    #[Route('/posts/{id}/comments/management', methods: ['GET'], name: "post_comment_management")]
    public function manageComment(int $id)
    {
        $post = $this->postRepository->find($id);
        if($post){
            return $this->redirectToRoute('posts_management');
        }

        $comment = $this->commentRepository->findBy(
            ["post" => $post],
            ['createdAt' => 'DESC']
        );
        return $this->render(
            "posts/admin/comment.management.html.twig",
            [ "comments" => [$comment], "role" => UserRoles::ADMIN->value ]
        );
    }


    #[Route('/categories', methods: ['GET', 'POST'], name: "page_categories")]
    public function getCategories()
    {

        $categories = $this->categoryRepository->findAll();

        return $this->render(
            "posts/admin/categories.html.twig",
            [ 
                "categories" => $categories,
                "role" => UserRoles::ADMIN->value
            ]
        );
    }

    #[Route('/categories/{id}', methods: ['GET', 'POST'], name: "page_category_edit")]
    public function editCategory(int $id, Request $request)
    {

        $cat = $this->categoryRepository->find($id);
        if(!$cat){
            return $this->redirectToRoute('page_categories');
        }

        $categoryForm = $this->createForm(CategoryType::class, $cat);
        $categoryForm->handleRequest($request);
        
        if($categoryForm->isSubmitted() && $categoryForm->isValid()){
            $this->em->persist($categoryForm->getData());
            $this->em->flush();

            return $this->redirectToRoute('page_categories', ['id' => $id]);
        }

        return $this->render(
            "posts/admin/edit.cat.html.twig",
            [ 
                "role" => UserRoles::ADMIN->value,
                "categoryForm"=>$categoryForm->createView(),
            ]
        );
    }

    #[Route('/users/view', methods: ['GET', 'POST'], name: "view_user_list")]
    public function userList(){
        $users = $this->userRepository->findAll();
        return $this->render(
            "posts/admin/users.html.twig",
            ["users"=>$users]
        );
    }

}