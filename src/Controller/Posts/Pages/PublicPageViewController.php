<?php

namespace App\Controller\Posts\Pages;

use App\Controller\Posts\CommentStatus;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CategoryRepository;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class PublicPageViewController extends AbstractController
{
    public function __construct(
        private PostRepository $postRepository,
        private CategoryRepository $categoryRepository,
        private CommentRepository $commentRepository,
        private EntityManagerInterface $em,
    )
    {}

    #[Route('/', methods: ['GET'], name: "pages_post")]
    public function viewAllPosts(){
        $user = $this->getUser();
        $role = $user?->getRoles()[0] ?? null;

        $posts = $this->postRepository->findBy(
            ['isPublished' => true,  ]
        );
        return $this->render(
            'posts/posts.html.twig',
            [
                'posts'=> $posts,
                'role' => $role
            ]
        );
    }

    /**
     * Here, any authentificated user can add a comment (in waiting)
     */
    #[Route('/posts/single/{id}', methods: ['GET', 'POST'], name: 'page_post')]
    public function viewSinglePost(
        int $id,
        Request $request
    ){
        $user = $this->getUser();
        $role = $user?->getRoles()[0] ?? null;

        $post = $this->postRepository->find($id);
        $comments = $this->commentRepository->findBy(
            ['post' => $post, "status" => CommentStatus::VALID ],
            ['createdAt' => 'DESC']
        );

        $newComment = new Comment();
        $form = $this->createForm(CommentType::class, $newComment);
        $form->handleRequest($request);

        if($user && $form->isSubmitted() && $form->isValid() && $request->request->has("comment_send")){
            $newComment->setStatus(CommentStatus::WAITING);
            $newComment->setPost($post);
            $newComment->setUser($user);

            $this->em->persist($newComment);
            $this->em->flush();
        }

        return $this->render('posts/post.html.twig', [
            'post' => $post,
            'role' => $role,
            'comments' => $role ?? $comments,       //visible by both user and admin
            'commentForm' => $form->createView()
        ]);
    }


}