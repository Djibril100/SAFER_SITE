<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie')]
    public function index(CategorieRepository $categorieRepository): Response
    {
        return $this->render('categorie/index.html.twig', [
            'categories' => $categorieRepository->findAll()
        ]);
    }

    #[Route('/categorie/{id}/show', name: 'app_categorie_show', methods: ['GET'])]
    public function show(Categorie $categorie, categorieRepository $rep): Response
    {
        $categories = $rep->findAll();
        return $this->render('categorie/partials/show.html.twig', [
            'categorie' => $categorie,
            'categories' => $categories
        ]);
    }
}
