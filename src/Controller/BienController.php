<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Bien;
use App\Repository\BienRepository;
use App\Repository\CategorieRepository;

class BienController extends AbstractController
{
    #[Route('/biens', name: 'app_bien')]
    public function index(BienRepository $bienRepository, CategorieRepository $rep): Response
    {
        return $this->render('bien/index.html.twig', [
            'current_menu' => 'biens',
            'categories' => $rep->findAll(),
            'biens' => $bienRepository->findAll()
        ]);
    }

    #[Route('/{id}/show', name: 'app_bien_show', methods: ['GET'])]
    public function show(Bien $bien, CategorieRepository $rep): Response
    {

        return $this->render('bien/partials/show.html.twig', [
            'categories' => $rep->findAll(),
            'bien' => $bien,

        ]);
    }
}
