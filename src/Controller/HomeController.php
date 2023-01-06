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
