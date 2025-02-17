<?php

namespace App\Controller;

use App\Entity\Reponsequiz;
use App\Form\ReponsequizType;
use App\Repository\ReponsequizRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/reponsequiz')]
final class ReponsequizController extends AbstractController
{
    #[Route(name: 'app_reponsequiz_index', methods: ['GET'])]
    public function index(ReponsequizRepository $reponsequizRepository): Response
    {
        return $this->render('reponsequiz/index.html.twig', [
            'reponsequizzes' => $reponsequizRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reponsequiz_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reponsequiz = new Reponsequiz();
        $form = $this->createForm(ReponsequizType::class, $reponsequiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reponsequiz);
            $entityManager->flush();

            return $this->redirectToRoute('app_reponsequiz_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reponsequiz/new.html.twig', [
            'reponsequiz' => $reponsequiz,
            'form' => $form,
        ]);
    }

    #[Route('/{id_rep}', name: 'app_reponsequiz_show', methods: ['GET'])]
    public function show(Reponsequiz $reponsequiz): Response
    {
        return $this->render('reponsequiz/show.html.twig', [
            'reponsequiz' => $reponsequiz,
        ]);
    }

    #[Route('/{id_rep}/edit', name: 'app_reponsequiz_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reponsequiz $reponsequiz, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReponsequizType::class, $reponsequiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reponsequiz_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reponsequiz/edit.html.twig', [
            'reponsequiz' => $reponsequiz,
            'form' => $form,
        ]);
    }

    #[Route('/{id_rep}', name: 'app_reponsequiz_delete', methods: ['POST'])]
    public function delete(Request $request, Reponsequiz $reponsequiz, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reponsequiz->getId_rep(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($reponsequiz);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reponsequiz_index', [], Response::HTTP_SEE_OTHER);
    }
}
