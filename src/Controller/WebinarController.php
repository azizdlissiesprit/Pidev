<?php

namespace App\Controller;

use App\Entity\Webinar;
use App\Form\WebinarType;
use App\Repository\WebinarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/webinar')]
final class WebinarController extends AbstractController
{
    #[Route(name: 'app_webinar_index', methods: ['GET'])]
    public function index(WebinarRepository $webinarRepository): Response
    {
        return $this->render('webinar/index.html.twig', [
            'webinars' => $webinarRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_webinar_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $webinar = new Webinar();
        $form = $this->createForm(WebinarType::class, $webinar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($webinar);
            $entityManager->flush();

            return $this->redirectToRoute('app_webinar_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('webinar/new.html.twig', [
            'webinar' => $webinar,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_webinar_show', methods: ['GET'])]
    public function show(Webinar $webinar): Response
    {
        return $this->render('webinar/show.html.twig', [
            'webinar' => $webinar,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_webinar_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Webinar $webinar, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(WebinarType::class, $webinar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_webinar_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('webinar/edit.html.twig', [
            'webinar' => $webinar,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_webinar_delete', methods: ['POST'])]
    public function delete(Request $request, Webinar $webinar, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$webinar->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($webinar);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_webinar_index', [], Response::HTTP_SEE_OTHER);
    }
}
