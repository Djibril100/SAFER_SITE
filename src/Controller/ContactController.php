<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\CategorieRepository;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(CategorieRepository $categorieRepository): Response
    {
        return $this->render('contact/index.html.twig', [
            'current_menu' => 'contact',
            'categories' => $categorieRepository->findAll()
        ]);
    }

    #[Route('/new', name: 'app_contact_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ContactRepository $contactRepository): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactRepository->save($contact, true);

            return $this->redirectToRoute('app_contact_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contact_crud/new.html.twig', [
            'contact' => $contact,
            'form' => $form,
        ]);
    }
}
