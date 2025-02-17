<?php

namespace App\Controller;

use App\Entity\WebinarResources;
use App\Form\WebinarResourcesType;
use App\Repository\WebinarResourcesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/webinar/resources')]
final class WebinarResourcesController extends AbstractController
{
    #[Route(name: 'app_webinar_resources_index', methods: ['GET'])]
    public function index(WebinarResourcesRepository $webinarResourcesRepository): Response
    {
        return $this->render('webinar_resources/index.html.twig', [
            'webinar_resources' => $webinarResourcesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_webinar_resources_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $webinarResource = new WebinarResources();
        $form = $this->createForm(WebinarResourcesType::class, $webinarResource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($webinarResource);
            $entityManager->flush();

            return $this->redirectToRoute('app_webinar_resources_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('webinar_resources/new.html.twig', [
            'webinar_resource' => $webinarResource,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_webinar_resources_show', methods: ['GET'])]
    public function show(WebinarResources $webinarResource): Response
    {
        return $this->render('webinar_resources/show.html.twig', [
            'webinar_resource' => $webinarResource,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_webinar_resources_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, WebinarResources $webinarResource, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(WebinarResourcesType::class, $webinarResource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_webinar_resources_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('webinar_resources/edit.html.twig', [
            'webinar_resource' => $webinarResource,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_webinar_resources_delete', methods: ['POST'])]
    public function delete(Request $request, WebinarResources $webinarResource, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$webinarResource->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($webinarResource);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_webinar_resources_index', [], Response::HTTP_SEE_OTHER);
    }
}
