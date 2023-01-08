<?php

namespace App\Controller;

use App\Entity\BienSearch;
use App\Entity\Categorie;
use App\Form\BienSearchType;
use App\Repository\BienRepository;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function show(Request $request, Categorie $categorie, categorieRepository $rep, BienRepository $bien): Response
    {
        $search = new BienSearch();
        $form = $this->createForm(BienSearchType::class, $search);
        $form->handleRequest($request);
        $categories = $rep->findAll($search);
        return $this->render('categorie/index.html.twig', [
            'categorie' => $categorie,
            'categories' => $categories,
            'form' => $form->createView()
        ]);
    }
}
