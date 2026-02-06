<?php

namespace App\Controller\Posts\Mock;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

/**
 * The same description as the PostSimpleController
 * The only difference is that this controller is focused on or oriented templates responses.
 * This controller used has templates those located in the posts/mock directory
 */
#[Route('/mock')]
class PostSimpleViewRenderController extends AbstractController
{
    public array $posts = [
        1 => ['title' => 'Premier post', 'content' => 'Contenu du post 1...'],
        2 => ['title' => 'Deuxième post', 'content' => 'Contenu du post 2...'],
        3 => ['title' => 'Troisième post', 'content' => 'Contenu du post 3...'],
    ];

    #[Route("/posts/overview", methods: ['GET'], name: "post_overview")]
    public function overwiew(){
        return $this->render('posts/mock/index.html.twig', [ 'posts'=> $this->posts ]);
    }
    

    #[Route("/posts/view/{id}", methods: ['GET'], name: "post_single")]
    public function singleView(int $id){
        return $this->render('posts/mock/single.html.twig',  ['post'=> $this->posts[$id]]);
    }


    #[Route("/posts/add", methods: ['GET'], name: "post_add")]
    public function add(){
        return $this->render('posts/mock/add.html.twig');
    }

    #[Route("/posts/edit/{id}", methods: ['GET'], name: "post_edit")]
    public function edit(int $id){
        $post = array_filter(
                $this->posts,
                fn($key) => $key === $id,
                ARRAY_FILTER_USE_KEY);
        return $this->render(
            'posts/edit.html.twig',
            [ "post" => $post ] 
        );
    }
}