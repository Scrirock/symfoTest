<?php

namespace App\Controller;

use App\Service\PlaceholderImageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/articles', name: 'articles_')]
class ArticleController extends AbstractController {

    private string $role = 'Admin';

    #[Route('/list', name: 'list')]
    public function list(): Response {
        return $this->render('articles/list.html.twig');
    }

    #[Route('/add', name: 'add')]
    public function add(): Response {
        if ($this->role === 'Admin') {
            return $this->render('articles/add.html.twig');
        }
        else {
            return $this->redirectToRoute('articles_list');
        }
    }

    #[Route('/edit/{id<\d+>}', name: 'edit')]
    public function edit(int $id): Response {
        if ($this->role === 'Admin') {
            return $this->render('articles/edit.html.twig', [
                'id' => $id
            ]);
        }
        else {
            return $this->redirectToRoute('articles_list');
        }
    }

    #[Route('/delete/{id<\d+>}', name: 'delete')]
    public function delete(int $id): Response {
        return $this->render('articles/delete.html.twig', [
            'id' => $id
        ]);
    }

    #[Route('/show/{id<\d+>}', name: 'show')]
    public function show(int $id): Response {
        return $this->render('articles/article.html.twig', [
            'id' => $id
        ]);
    }

}