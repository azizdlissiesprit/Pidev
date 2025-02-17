<?php

namespace App\Controller;

use App\Entity\WebinarFeedback;
use App\Form\WebinarFeedbackType;
use App\Repository\WebinarFeedbackRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/webinar/feedback')]
final class WebinarFeedbackController extends AbstractController
{
    #[Route(name: 'app_webinar_feedback_index', methods: ['GET'])]
    public function index(WebinarFeedbackRepository $webinarFeedbackRepository): Response
    {
        return $this->render('webinar_feedback/index.html.twig', [
            'webinar_feedbacks' => $webinarFeedbackRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_webinar_feedback_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $webinarFeedback = new WebinarFeedback();
        $form = $this->createForm(WebinarFeedbackType::class, $webinarFeedback);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($webinarFeedback);
            $entityManager->flush();

            return $this->redirectToRoute('app_webinar_feedback_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('webinar_feedback/new.html.twig', [
            'webinar_feedback' => $webinarFeedback,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_webinar_feedback_show', methods: ['GET'])]
    public function show(WebinarFeedback $webinarFeedback): Response
    {
        return $this->render('webinar_feedback/show.html.twig', [
            'webinar_feedback' => $webinarFeedback,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_webinar_feedback_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, WebinarFeedback $webinarFeedback, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(WebinarFeedbackType::class, $webinarFeedback);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_webinar_feedback_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('webinar_feedback/edit.html.twig', [
            'webinar_feedback' => $webinarFeedback,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_webinar_feedback_delete', methods: ['POST'])]
    public function delete(Request $request, WebinarFeedback $webinarFeedback, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$webinarFeedback->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($webinarFeedback);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_webinar_feedback_index', [], Response::HTTP_SEE_OTHER);
    }
}
