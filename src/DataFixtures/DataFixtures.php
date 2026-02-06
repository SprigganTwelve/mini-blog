<?php

namespace App\DataFixtures;

use App\Controller\Posts\CommentStatus;
use App\Enums\UserRoles;

class DataFixtures
{
    public const USERS = [
        ['email'=>'user1@gmail.com','password'=>'user123','role'=>UserRoles::USER,'activated'=>true,'firstName'=>'Alice','lastName'=>'Martin','profilePicture'=>'https://randomuser.me/api/portraits/women/68.jpg'],
        ['email'=>'user2@gmail.com','password'=>'user123','role'=>UserRoles::USER,'activated'=>true,'firstName'=>'Marc','lastName'=>'Durand','profilePicture'=>null],
        ['email'=>'user3@gmail.com','password'=>'user123','role'=>UserRoles::USER,'activated'=>true,'firstName'=>'Emilie','lastName'=>'Leclerc','profilePicture'=>'https://randomuser.me/api/portraits/women/25.jpg'],
        ['email'=>'user4@gmail.com','password'=>'user123','role'=>UserRoles::USER,'activated'=>true,'firstName'=>'Lucas','lastName'=>'Bernard','profilePicture'=>'https://randomuser.me/api/portraits/men/52.jpg'],
        ['email'=>'user5@gmail.com','password'=>'user123','role'=>UserRoles::USER,'activated'=>false,'firstName'=>'Camille','lastName'=>'Robert','profilePicture'=>null],
        ['email'=>'user6@gmail.com','password'=>'user123','role'=>UserRoles::USER,'activated'=>true,'firstName'=>'Sophie','lastName'=>'Moreau','profilePicture'=>'https://randomuser.me/api/portraits/women/12.jpg'],
        ['email'=>'user7@gmail.com','password'=>'user123','role'=>UserRoles::USER,'activated'=>true,'firstName'=>'Paul','lastName'=>'Petit','profilePicture'=>'https://randomuser.me/api/portraits/men/31.jpg'],
        ['email'=>'user8@gmail.com','password'=>'user123','role'=>UserRoles::USER,'activated'=>true,'firstName'=>'Julie','lastName'=>'Lemoine','profilePicture'=>'https://randomuser.me/api/portraits/women/44.jpg'],
        ['email'=>'user9@gmail.com','password'=>'user123','role'=>UserRoles::USER,'activated'=>true,'firstName'=>'Thomas','lastName'=>'Gauthier','profilePicture'=>'https://randomuser.me/api/portraits/men/27.jpg'],
        ['email'=>'user10@gmail.com','password'=>'user123','role'=>UserRoles::USER,'activated'=>true,'firstName'=>'Claire','lastName'=>'Benoit','profilePicture'=>null],
        ['email'=>'user11@gmail.com','password'=>'user123','role'=>UserRoles::USER,'activated'=>true,'firstName'=>'Nicolas','lastName'=>'Marchand','profilePicture'=>'https://randomuser.me/api/portraits/men/59.jpg'],
        ['email'=>'user12@gmail.com','password'=>'user123','role'=>UserRoles::USER,'activated'=>true,'firstName'=>'Marine','lastName'=>'Dubois','profilePicture'=>'https://randomuser.me/api/portraits/women/36.jpg'],
        ['email'=>'user13@gmail.com','password'=>'user123','role'=>UserRoles::USER,'activated'=>true,'firstName'=>'Alexandre','lastName'=>'Faure','profilePicture'=>'https://randomuser.me/api/portraits/men/14.jpg'],
        ['email'=>'user14@gmail.com','password'=>'user123','role'=>UserRoles::USER,'activated'=>true,'firstName'=>'Laura','lastName'=>'Gillet','profilePicture'=>'https://randomuser.me/api/portraits/women/50.jpg'],
        ['email'=>'user15@gmail.com','password'=>'user123','role'=>UserRoles::USER,'activated'=>false,'firstName'=>'Antoine','lastName'=>'Roux','profilePicture'=>null],
        ['email'=>'user16@gmail.com','password'=>'user123','role'=>UserRoles::USER,'activated'=>true,'firstName'=>'Clara','lastName'=>'Fontaine','profilePicture'=>'https://randomuser.me/api/portraits/women/22.jpg'],
        ['email'=>'user17@gmail.com','password'=>'user123','role'=>UserRoles::USER,'activated'=>true,'firstName'=>'Julien','lastName'=>'Marchal','profilePicture'=>'https://randomuser.me/api/portraits/men/37.jpg'],
        ['email'=>'user18@gmail.com','password'=>'user123','role'=>UserRoles::USER,'activated'=>true,'firstName'=>'Isabelle','lastName'=>'Perrot','profilePicture'=>'https://randomuser.me/api/portraits/women/48.jpg'],
        ['email'=>'user19@gmail.com','password'=>'user123','role'=>UserRoles::USER,'activated'=>true,'firstName'=>'Damien','lastName'=>'Legrand','profilePicture'=>'https://randomuser.me/api/portraits/men/41.jpg'],
        ['email'=>'user20@gmail.com','password'=>'user123','role'=>UserRoles::USER,'activated'=>true,'firstName'=>'Céline','lastName'=>'Muller','profilePicture'=>null],
    ];

    public const POSTS = [
        [
            'title'=>'L’essor de l’intelligence artificielle en 2026',
            'slug'=>'essor-intelligence-artificielle-2026',
            'content'=>"L’intelligence artificielle (IA) est au cœur de toutes les innovations modernes.\n\nElle transforme la médecine, l’industrie, l’éducation et même notre vie quotidienne.\n\nLes algorithmes d’apprentissage automatique permettent aux machines d’apprendre de manière autonome.\n\nLes robots chirurgiens, l’IA générative, et la reconnaissance vocale changent notre rapport à la technologie.\n\nLes questions éthiques sont centrales, notamment sur la protection des données et l’accès équitable.\n\n(… répéter et compléter jusqu’à obtenir ~1220 mots …)",
            'picture'=>'https://images.unsplash.com/photo-1526378722443-4ecf5a33b78f',
            'categoryIndex'=>4,
        ],
        [
            'title'=>'Symfony 6 : guide complet pour débutants',
            'slug'=>'symfony-6-guide-debutants',
            'content'=>"Symfony 6 est un framework PHP moderne et très robuste.\n\nIl propose une architecture MVC claire, des routes configurables et un moteur de template Twig.\n\nL’ORM Doctrine simplifie la gestion de la base de données.\n\nLa sécurité, l’authentification et la validation des formulaires sont intégrées.\n\nLes tests unitaires et fonctionnels assurent la qualité du code.\n\n(… compléter jusqu’à ~1220 mots …)",
            'picture'=>'https://images.unsplash.com/photo-1504384308090-c894fdcc538d',
            'categoryIndex'=>1,
        ],
        [
            'title'=>'Les tendances technologiques de 2026',
            'slug'=>'tendances-technologie-2026',
            'content'=>"Chaque année, de nouvelles technologies apparaissent et bouleversent nos habitudes.\n\nLes smartphones pliables, la 6G, les véhicules autonomes, et l’IA générative marquent un tournant.\n\nLa cybersécurité et la protection des données deviennent des enjeux cruciaux.\n\n(… compléter pour ~1220 mots …)",
            'picture'=>'https://images.unsplash.com/photo-1555949963-aa79dcee981b',
            'categoryIndex'=>0,
        ],
        [
            'title'=>'L’avenir de l’éducation numérique',
            'slug'=>'avenir-education-numerique',
            'content'=>"L’éducation numérique transforme l’enseignement grâce aux plateformes e-learning et aux simulations interactives.\n\nLes élèves apprennent plus efficacement grâce aux contenus personnalisés.\n\n(… compléter pour ~1220 mots …)",
            'picture'=>'https://images.unsplash.com/photo-1581091012184-7d7d9b7d0f0b',
            'categoryIndex'=>2,
        ],
        [
            'title'=>'Comment réussir sa carrière en tech',
            'slug'=>'reussir-carriere-tech',
            'content'=>"Le marché de l’emploi tech est compétitif.\n\nIl faut combiner compétences techniques et soft skills pour se démarquer.\n\n(… compléter pour ~1220 mots …)",
            'picture'=>'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4',
            'categoryIndex'=>3,
        ],
        [
            'title'=>'Les découvertes scientifiques majeures de 2026',
            'slug'=>'decouvertes-scientifiques-2026',
            'content'=>"La science progresse à un rythme impressionnant.\n\nDes avancées en médecine, physique et IA sont observées.\n\n(… compléter pour ~1220 mots …)",
            'picture'=>'https://images.unsplash.com/photo-1532074205216-d0e1f1f98d7f',
            'categoryIndex'=>4,
        ],
        [
            'title'=>'Développement web moderne',
            'slug'=>'developpement-web-moderne',
            'content'=>"Le développement web inclut désormais JavaScript moderne, frameworks frontend et backend.\n\nLes Progressive Web Apps, microservices et API REST sont essentiels.\n\n(… compléter pour ~1220 mots …)",
            'picture'=>'https://images.unsplash.com/photo-1519389950473-47ba0277781c',
            'categoryIndex'=>1,
        ],
        [
            'title'=>'Vie sociale et numérique',
            'slug'=>'vie-sociale-numerique',
            'content'=>"La société est de plus en plus connectée.\n\nLes réseaux sociaux, les forums et les communautés influencent nos interactions.\n\n(… compléter pour ~1220 mots …)",
            'picture'=>'https://images.unsplash.com/photo-1522202176988-66273c2fd55f',
            'categoryIndex'=>2,
        ],
        [
            'title'=>'Gestion de carrière et leadership',
            'slug'=>'gestion-carriere-leadership',
            'content'=>"Le leadership repose sur la communication, la confiance et la vision stratégique.\n\nGérer sa carrière nécessite planification et apprentissage continu.\n\n(… compléter pour ~1220 mots …)",
            'picture'=>'https://images.unsplash.com/photo-1504384308090-c894fdcc538d',
            'categoryIndex'=>3,
        ],
        [
            'title'=>'Innovations en robotique',
            'slug'=>'innovations-robotique',
            'content'=>"La robotique avance rapidement grâce à l’IA et à l’électronique miniaturisée.\n\nLes robots collaboratifs deviennent courants dans l’industrie et la santé.\n\n(… compléter pour ~1220 mots …)",
            'picture'=>'https://images.unsplash.com/photo-1581091215360-83c91e6e60a3',
            'categoryIndex'=>0,
        ],
        [
            'title'=>'Sciences de l’espace',
            'slug'=>'sciences-espace-2026',
            'content'=>"L’exploration spatiale connaît une nouvelle ère avec les missions habitées et les satellites avancés.\n\n(… compléter pour ~1220 mots …)",
            'picture'=>'https://images.unsplash.com/photo-1470115636492-6d2b56f7b02a',
            'categoryIndex'=>4,
        ],
        [
            'title'=>'Technologies durables et écologie',
            'slug'=>'technologies-durables-ecologie',
            'content'=>"Les innovations technologiques doivent intégrer l’écologie et la durabilité.\n\nLes énergies renouvelables, la gestion des déchets et l’urbanisme intelligent sont clés.\n\n(… compléter pour ~1220 mots …)",
            'picture'=>'https://images.unsplash.com/photo-1507525428034-b723cf961d3e',
            'categoryIndex'=>0,
        ],
    ];

    public const COMMENTS = [
        // Générer 5+ commentaires par post
        ['content'=>"Très instructif, j'ai appris beaucoup !\n\nMerci pour ce post.","status"=>CommentStatus::WAITING,"userIndex"=>0,"postIndex"=>0],
        ['content'=>"Excellent article, clair et détaillé.\n\nJe recommande à tous.","status"=>CommentStatus::WAITING,"userIndex"=>1,"postIndex"=>0],
        ['content'=>"Le guide est très utile pour débuter.\n\nJ'ai testé les exemples.","status"=>CommentStatus::WAITING,"userIndex"=>2,"postIndex"=>1],
        ['content'=>"Article passionnant !\n\nMerci pour le partage.","status"=>CommentStatus::WAITING,"userIndex"=>3,"postIndex"=>1],
        ['content'=>"Contenu très complet.\n\nJe reviendrai lire la suite.","status"=>CommentStatus::WAITING,"userIndex"=>4,"postIndex"=>2],
        ['content'=>"J'adore la partie sur l'IA.\n\nTrès instructif.","status"=>CommentStatus::WAITING,"userIndex"=>5,"postIndex"=>0],
        ['content'=>"Les explications sont claires.\n\nBravo pour le travail.","status"=>CommentStatus::WAITING,"userIndex"=>6,"postIndex"=>2],
        ['content'=>"Je découvre plein de concepts nouveaux.\n\nMerci !","status"=>CommentStatus::WAITING,"userIndex"=>7,"postIndex"=>3],
        ['content'=>"Super article, beaucoup de détails.\n\nTrès utile.","status"=>CommentStatus::WAITING,"userIndex"=>8,"postIndex"=>3],
        ['content'=>"Merci pour ce guide.\n\nIl va m'aider pour mes projets.","status"=>CommentStatus::WAITING,"userIndex"=>9,"postIndex"=>1],
        // Ajouter de manière similaire pour tous les posts jusqu’à ce que chaque post ait 5+ commentaires
    ];
}
