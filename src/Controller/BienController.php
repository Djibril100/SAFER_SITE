<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Bien;
use App\Repository\BienRepository;
use App\Repository\CategorieRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;


class BienController extends AbstractController
{
    #[Route('/biens', name: 'app_bien')]
    public function index(Request $request, BienRepository $bienRepository, CategorieRepository $rep, PaginatorInterface $paginator): Response
    {
        $biens = $bienRepository->findAll();
        $biens = $paginator->paginate(
            $biens,
            $request->query->getInt('page', 1), /*page number*/
            limit: 6
        );
        return $this->render('bien/index.html.twig', [
            'current_menu' => 'biens',
            'categories' => $rep->findAll(),
            'biens' => $biens
        ]);
    }

    #[Route('/{id}/show', name: 'app_bien_show', methods: ['GET'])]
    public function show(Bien $bien, CategorieRepository $rep): Response
    {

        return $this->render('bien/partials/show.html.twig', [
            'categories' => $rep->findAll(),
            'bien' => $bien

        ]);
    }
}
