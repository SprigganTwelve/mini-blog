<?php

namespace App\Controller\Posts;

use App\Entity\Comment;
use App\Entity\Post;
use App\Repository\CategoryRepository;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

// #[IsGranted('ROLE_ADMIN')]
#[Route('/admin')]
class PostAdminController extends AbstractController
{
    public function __construct(
        private PostRepository $postRepository,
        private UserRepository $userRepository,
        private CommentRepository $commentRepository,
        private CategoryRepository $categoryRepository,
        private EntityManagerInterface $em,
    ){
    }

    #[Route('/posts/{id}', name: 'post_delete', methods: ['POST'])]
    public function delete(Post $post, Request $request)
    {
        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->request->get('_token'))) {
            $this->em->remove($post);
            $this->em->flush();
        }

        return $this->redirectToRoute('posts_management');
    }


    #[Route("/posts/toggle/publish/{id}", methods: ['POST'],  name: "posts_toggle_publish")]
    public function publish(
        int $id,
        Request $request,
    )
    {
        $post = $this->postRepository->find($id);
        if($post && $this->isCsrfTokenValid('publish'.$post->getId(),  $request->request->get('_token'))){
            $post->setIsPublished(!$post->getIsPublished());
            $date = new DateTimeImmutable();
            $post->setPublishedAt($date);
            $this->em->flush();
        }
        return $this->redirectToRoute('posts_management');
    }


    #[Route('/categories/delete/{id}', methods: ['POST'], name: "delete_categpory")]
    public function deleteCategory(int $id, Request $request)
    {
        $cat = $this->categoryRepository->find($id);
        if($cat && $this->isCsrfTokenValid('delete'.$cat->getId(), $request->request->get("_token"))){
            $this->em->remove($cat);
            $this->em->flush();
        }
        return $this->redirect(
                $request->headers->get('referer') 
                ?? $this->generateUrl('page_post_add'));
    }
    

    #[Route('/comment/approve/{id}', methods: ['POST'], name: "admin_approve_comment")]
    public function approveComment(int $id, Request $request)
    {
        $comment = $this->commentRepository->find($id);
        if($comment && $this->isCsrfTokenValid("approve".$comment->getId(), $request->request->get("_token"))){
            $comment->setStatus(CommentStatus::VALID);
            $this->em->flush();
        }
        return $this->redirect(
                $request->headers->get('referer') 
                ?? $this->generateUrl('page_post_add'));
    }


    #[Route('/comment/disapprove/{id}', methods: ['POST'], name: "admin_desapprove_comment")]
    public function diapproveComment(int $id, Request $request){
        $comment = $this->commentRepository->find($id);
        if($comment && $this->isCsrfTokenValid("disapprove".$comment->getId(), $request->request->get("_token"))){
            $comment->setStatus(CommentStatus::UNAPPROVE);
            $this->em->flush();
        }
        return $this->redirect(
                $request->headers->get('referer') 
                ?? $this->generateUrl('page_post_add'));
    }


    #[Route('/user/activate/{id}', methods: ['POST'], name: "user_toggle_activate")]
    public function activateUser(int $id, Request $request)
    {
        $user = $this->userRepository->find($id);
        if($user && $this->isCsrfTokenValid('activate'.$user->getId(),  $request->request->get('_token'))){
            $user->setActivated(!$user->getActivated());
            $this->em->flush();
        }
        return $this->redirectToRoute('posts_management');
    }
}