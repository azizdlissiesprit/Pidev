<?php

namespace App\Controller;

use App\Entity\WebinarChat;
use App\Form\WebinarChatType;
use App\Repository\WebinarChatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/webinar/chat')]
final class WebinarChatController extends AbstractController
{
    #[Route(name: 'app_webinar_chat_index', methods: ['GET'])]
    public function index(WebinarChatRepository $webinarChatRepository): Response
    {
        return $this->render('webinar_chat/index.html.twig', [
            'webinar_chats' => $webinarChatRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_webinar_chat_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $webinarChat = new WebinarChat();
        $form = $this->createForm(WebinarChatType::class, $webinarChat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($webinarChat);
            $entityManager->flush();

            return $this->redirectToRoute('app_webinar_chat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('webinar_chat/new.html.twig', [
            'webinar_chat' => $webinarChat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_webinar_chat_show', methods: ['GET'])]
    public function show(WebinarChat $webinarChat): Response
    {
        return $this->render('webinar_chat/show.html.twig', [
            'webinar_chat' => $webinarChat,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_webinar_chat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, WebinarChat $webinarChat, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(WebinarChatType::class, $webinarChat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_webinar_chat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('webinar_chat/edit.html.twig', [
            'webinar_chat' => $webinarChat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_webinar_chat_delete', methods: ['POST'])]
    public function delete(Request $request, WebinarChat $webinarChat, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$webinarChat->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($webinarChat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_webinar_chat_index', [], Response::HTTP_SEE_OTHER);
    }
}
