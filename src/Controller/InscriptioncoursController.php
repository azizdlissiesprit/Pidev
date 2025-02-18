<?php

namespace App\Controller;

use App\Entity\Inscriptioncours;
use App\Form\InscriptioncoursType;
use App\Repository\InscriptioncoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/inscriptioncours')]
final class InscriptioncoursController extends AbstractController
{
    #[Route(name: 'app_inscriptioncours_index', methods: ['GET'])]
    public function index(InscriptioncoursRepository $inscriptioncoursRepository): Response
    {
        return $this->render('inscriptioncours/index.html.twig', [
            'inscriptioncours' => $inscriptioncoursRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_inscriptioncours_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $inscriptioncour = new Inscriptioncours();
        $form = $this->createForm(InscriptioncoursType::class, $inscriptioncour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($inscriptioncour);
            $entityManager->flush();

            return $this->redirectToRoute('app_inscriptioncours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('inscriptioncours/new.html.twig', [
            'inscriptioncour' => $inscriptioncour,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_inscriptioncours_show', methods: ['GET'])]
    public function show(Inscriptioncours $inscriptioncour): Response
    {
        return $this->render('inscriptioncours/show.html.twig', [
            'inscriptioncour' => $inscriptioncour,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_inscriptioncours_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Inscriptioncours $inscriptioncour, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InscriptioncoursType::class, $inscriptioncour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_inscriptioncours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('inscriptioncours/edit.html.twig', [
            'inscriptioncour' => $inscriptioncour,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_inscriptioncours_delete', methods: ['POST'])]
    public function delete(Request $request, Inscriptioncours $inscriptioncour, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inscriptioncour->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($inscriptioncour);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_inscriptioncours_index', [], Response::HTTP_SEE_OTHER);
    }
}
