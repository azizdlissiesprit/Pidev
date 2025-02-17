<?php

namespace App\Controller;

use App\Entity\Questionquiz;
use App\Entity\Quiz; // Add this import
use App\Form\QuestionquizType;
use App\Repository\QuestionquizRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/questionquiz')]
final class QuestionquizController extends AbstractController
{
    #[Route(name: 'app_questionquiz_index', methods: ['GET'])]
    public function index(QuestionquizRepository $questionquizRepository): Response
    {
        return $this->render('questionquiz/index.html.twig', [
            'questionquizzes' => $questionquizRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_questionquiz_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $questionquiz = new Questionquiz();
        $questionquiz->setDateCreation(new \DateTime()); // Définir la date de création
        
        $form = $this->createForm(QuestionquizType::class, $questionquiz);
        $form->handleRequest($request);
    
        try {
            if ($form->isSubmitted() && $form->isValid()) {
                // Debug information
                dump($questionquiz); // Vérifiez les données avant la persistance
                
                $entityManager->persist($questionquiz);
                $entityManager->flush();
    
                $this->addFlash('success', 'Question created successfully');
                return $this->redirectToRoute('app_questionquiz_index');
            }
        } catch (\Exception $e) {
            // Log the error
            $this->addFlash('error', 'An error occurred: ' . $e->getMessage());
        }
    
        return $this->render('questionquiz/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/show/{id}', name: 'app_questionquiz_show', methods: ['GET'])]
    public function show(Questionquiz $questionquiz): Response
    {
        return $this->render('questionquiz/show.html.twig', [
            'questionquiz' => $questionquiz,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_questionquiz_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Questionquiz $questionquiz, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(QuestionquizType::class, $questionquiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Ensure the quiz relationship is updated
            $quiz = $questionquiz->getQuiz();
            if ($quiz) {
                $questionquiz->setQuiz($quiz);
            }

            $entityManager->flush();

            $this->addFlash('success', 'Questionquiz updated successfully!');
            return $this->redirectToRoute('app_questionquiz_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('questionquiz/edit.html.twig', [
            'questionquiz' => $questionquiz,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/delete/{id}', name: 'app_questionquiz_delete', methods: ['POST'])]
    public function delete(Request $request, Questionquiz $questionquiz, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$questionquiz->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($questionquiz);
            $entityManager->flush();

            $this->addFlash('success', 'Questionquiz deleted successfully!');
        } else {
            $this->addFlash('error', 'Invalid CSRF token.');
        }

        return $this->redirectToRoute('app_questionquiz_index', [], Response::HTTP_SEE_OTHER);
    } #[Route(path: '/home', name: 'question_home')]
    public function home(QuestionquizRepository $questionquizRepository): Response
    {
        $question = $questionquizRepository->findAll();

        return $this->render('homequiz/question.html.twig', [
            'questions' => $question,
        ]);
    }
}