<?php

namespace App\Controller\Posts\Mock;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * This one is just to realize some pratical test.
 * It does not test the application itself, just simulate something like one with
 * mock data.
 * The mock data has nothing to do with the ones created from FixturesLoader;
 */
#[Route('/mock')]
final class PostSimpleController extends AbstractController
{
    public array $posts = [
        1 => ['title' => 'Premier post', 'content' => 'Contenu du post 1...'],
        2 => ['title' => 'Deuxième post', 'content' => 'Contenu du post 2...'],
        3 => ['title' => 'Troisième post', 'content' => 'Contenu du post 3...'],
    ];


    #[Route('/posts', name: 'mock_app_post')]
    public function index(): Response
    {
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }



    #[Route("/posts", methods: ['GET'], name: "mock_posts_get_all")]
    public function list(){
        return new Response((string) $this->posts, Response::HTTP_OK);
    }



    #[Route("/posts/{id}", methods:['GET'] ,name: "mock_posts_get_one")]
    public function getById(int $id):Response
    {
        return new Response(
            (string)array_filter(
                $this->posts,
                fn($key) => $key === $id,
                ARRAY_FILTER_USE_KEY)
            );
    }



    #[Route('/posts/{id}', methods: ['PUT'], name: "mock_post_full_change")]
    public function changeAllProperty(int $id, Request $request){
        $body = json_decode($request->getContent(), true);
        $this->posts[$id]['title'] = $body['title'];
        $this->posts[$id]['content'] = $body['content'];
        return new Response('Everything went according to process');
    }



    #[Route("/posts/{id}", methods: ['DELETE'], name: "mock_posts_delete")]
    public function deletePost(int $id): Response
    {
        unset($this->posts[$id]);
        return new Response("Everything went smoothly", Response::HTTP_OK);
    }
    
}
