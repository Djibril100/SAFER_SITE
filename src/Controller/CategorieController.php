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
    /*
    La methode index prend en parametre : un objet "CategorieRepository"
    Cette methode sera execute lors de l'appel de la route "app_categorie"
    Cette methode nous retourne : 
        - 'categories' qui nous est utile lorsque l'on souhaite connaitre l'ensemble des categorie (par exemple dans le nav) 
*/
    #[Route('/categorie', name: 'app_categorie')]
    public function index(CategorieRepository $categorieRepository): Response
    {
        return $this->render('categorie/index.html.twig', [
            'categories' => $categorieRepository->findAll()

        ]);
    }

    /*
    La methode show prend en parametre : un objet Request, un objet Categorie, un objet categorieRepository, un objet BienRepository
    Cette methode sera execute lors de l'appel de la route "app_categorie_show"
    Cette methode nous retourne : 
        - 'form', le formulaire de recherche avancee
        - 'categories' qui nous est utile lorsque l'on souhaite connaitre l'ensemble des cattegories (par exemple dans le nav) 
        - 'categorie' qui nous renvoie une categorie
*/
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
