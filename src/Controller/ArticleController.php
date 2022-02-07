<?php

namespace App\Controller;

use App\Service\PlaceholderImageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/articles', name: 'articles_')]
class ArticleController extends AbstractController {

    #[Route('/list', name: 'list')]
    public function list(): Response {
        return new Response('<h1>Liste des articles</h1>');
    }

    #[Route('/add', name: 'add')]
    public function add(PlaceholderImageService $placeholderImage): Response {
        try {
            $success = $placeholderImage->getNewImageAndSave(350, 350, 'image.png');
        }
        catch (\Error $e) {
            $success = false;
        }

        if ($success) {
            return new Response('<h1>Article créé avec succès</h1>');
        }
        return new Response('<h1>Y\'a eu un soucis</h1>');
    }

    #[Route('/edit/{id<\d+>}', name: 'edit')]
    public function edit(int $id): Response {
        return new Response("<h1>Modifie l'article n° $id</h1>");
    }

    #[Route('/delete/{id<\d+>}', name: 'delete')]
    public function delete(int $id): Response {
        return new Response("<h1>Supprime l'article n° $id</h1>");
    }

    #[Route('/show/{id<\d+>}', name: 'show')]
    public function show(int $id): Response {
        return new Response("<h1>Montre l'article n° $id</h1>");
    }

}