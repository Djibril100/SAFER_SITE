<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BienRepository;

class BienController extends AbstractController
{
    #[Route('/biens', name: 'app_bien')]
    public function index(BienRepository $bienRepository): Response
    {
        return $this->render('bien/index.html.twig', [
            'current_menu' => 'biens',
            'biens' => $bienRepository->findAll()
        ]);
    }
}
