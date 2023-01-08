<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Repository\BienRepository;
use App\Form\BienType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/*
    Ce controller a été generer automatiquement à l'aide de commande make:crud
    Cette classe permet de creer, editer, voir et supprimer des biens
*/

#[Route('admin/bien')]
class BienCrudController extends AbstractController
{
    #[Route('/', name: 'app_bien_crud_index', methods: ['GET'])]
    public function index(BienRepository $bienRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $biens = $bienRepository->findAll();
        $biens = $paginator->paginate(
            $biens,
            $request->query->getInt('page', 1), /*page number*/
            limit: 5
        );
        return $this->render('bien_crud/index.html.twig', [
            'biens' => $biens,
        ]);
    }

    #[Route('/new', name: 'app_bien_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BienRepository $bienRepository): Response
    {
        $bien = new Bien();
        $form = $this->createForm(BienType::class, $bien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bienRepository->save($bien, true);

            return $this->redirectToRoute('app_bien_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bien_crud/new.html.twig', [
            'bien' => $bien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bien_crud_show', methods: ['GET'])]
    public function show(Bien $bien): Response
    {
        return $this->render('bien_crud/show.html.twig', [
            'bien' => $bien,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bien_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bien $bien, BienRepository $bienRepository): Response
    {
        $form = $this->createForm(BienType::class, $bien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bienRepository->save($bien, true);

            return $this->redirectToRoute('app_bien_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bien_crud/edit.html.twig', [
            'bien' => $bien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bien_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Bien $bien, BienRepository $bienRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $bien->getId(), $request->request->get('_token'))) {
            $bienRepository->remove($bien, true);
        }

        return $this->redirectToRoute('app_bien_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
