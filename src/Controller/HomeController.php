<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategorieRepository;
use App\Entity\Bien;
use App\Repository\BienRepository;

class HomeController extends AbstractController
{
     /*
    La methode index prend en parametre : un objet CategorieRepository, un objet BienRepository
    Cette methode sera execute lors de l'appel de la route "app_home"
    Cette methode nous retourne : 
        - 'current_menu' qui nous est utile pour spécifier dans le nav l'endroit ou l'on se trouve
        - 'categories' qui nous est utile lorsque l'on souhaite connaitre l'ensemble des categorie (par exemple dans le nav) 
        - 'biens' qui nous est utile lorque car ici on souhaite afficher 3 biens ces 3 biens ont été generer aleatoirement avec shuffle et array_slice 
    */
    #[Route('/', name: 'app_home')]
    public function index(CategorieRepository $categorieRepository, BienRepository $bienRepository): Response
    {
        #$biens = $categorieRepository->findAll();
        # les trois lignes suivante serve à la génération de trois biens aléatoire
        $biens = $bienRepository->findAll();
        shuffle($biens);
        $randomBiens = array_slice($biens, 0, 3);

        return $this->render('home/index.html.twig', [
            'current_menu' => 'home',
            'categories' => $categorieRepository->findAll(),
            #'biens' => $bienRepository->findAll()
            'biens' => $randomBiens

        ]);
    }

     /*
    La methode show prend en parametre : un objet Bien, un objet BienRepository
    Cette methode sera execute lors de l'appel de la route "app_home_show"
    Cette methode nous retourne : 
        - 'categories' qui nous est utile lorsque l'on souhaite connaitre l'ensemble des categorie (par exemple dans le nav) 
        - 'biens' qui nous est utile lorque car ici on souhaite afficher 3 biens ces 3 biens ont été generer aleatoirement avec shuffle et array_slice 
    */
    #[Route('/{id}/show', name: 'app_home_show', methods: ['GET'])]
    public function show(Bien $biens, CategorieRepository $rep): Response
    {
        $biens = $rep->findAll();
        return $this->render('bien/parties/show.html.twig', [
            'categories' => $rep->findAll(),
            'biens' => $biens,

        ]);
    }
}
