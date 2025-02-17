<?php
// src/Controller/PostController.php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Tag;
use App\Entity\Comment;
use App\Form\PostType;
use App\Form\CommentType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/post')]
class PostController extends AbstractController
{
    // Show a single post and handle adding comments
    #[Route('/{id}/show', name: 'app_post_show')]
    public function show(Request $request, Post $post, EntityManagerInterface $entityManager): Response
    {
        // Fetch all tags for the dropdown
        $allTags = $entityManager->getRepository(Tag::class)->findAll();
    
        // Create comment form
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setPost($post);
            $entityManager->persist($comment);
            $entityManager->flush();
    
            return $this->redirectToRoute('app_post_show', ['id' => $post->getId()]);
        }
    
        return $this->render('post/show.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
            'allTags' => $allTags,  // Pass all tags to the view
        ]);
    }

    // List all posts
    #[Route('/', name: 'app_post_index', methods: ['GET'])]
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findAll();

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }

   // src/Controller/PostController.php

#[Route('/new', name: 'app_post_new', methods: ['GET', 'POST'])]
public function new(Request $request, EntityManagerInterface $entityManager): Response
{
    $post = new Post(); // New instance of Post

    $form = $this->createForm(PostType::class, $post); // Create the form bound to the new post
    $form->handleRequest($request); // Handle the form submission

    if ($form->isSubmitted() && $form->isValid()) { // If form is submitted and valid
        $entityManager->persist($post); // Persist the post
        $entityManager->flush(); // Commit to the database

        return $this->redirectToRoute('app_post_index'); // Redirect to the list of posts
    }

    return $this->render('post/new.html.twig', [
        'form' => $form->createView(), // Pass form to the view
    ]);
}

    // Edit an existing post
    #[Route('/{id}/edit', name: 'app_post_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Post $post, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_post_index');
        }

        return $this->render('post/edit.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

    // Delete a post
    #[Route('/{id}', name: 'app_post_delete', methods: ['POST', 'DELETE'])]
    public function delete(Request $request, Post $post, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->request->get('_token'))) {
            $entityManager->remove($post);
            $entityManager->flush();
        }
    
        return $this->redirectToRoute('app_post_index');
    }


    // Show all posts with the option to add comments
    #[Route('/home', name: 'app_home')]
    public function home(PostRepository $postRepository): Response
    {
        // Retrieve all posts from the database.
        $posts = $postRepository->findAll();

        // Prepare an array to store a comment form view for each post.
        $forms = [];
        foreach ($posts as $post) {
            // Create a new Comment instance and form for this post.
            $comment = new Comment();
            $form = $this->createForm(CommentType::class, $comment);
            // (We do not handle submission here.)
            $forms[$post->getId()] = $form->createView();
        }

        return $this->render('home/index.html.twig', [
            'posts' => $posts,
            'forms' => $forms,
        ]);
    }

    /**
     * Handle comment submission from the homepage.
     */
    #[Route('/comment/new', name: 'app_comment_new', methods: ['POST'])]
    public function newComment(
        Request $request,
        PostRepository $postRepository,
        EntityManagerInterface $entityManager
    ): Response {
        // Get the ID of the post from the submitted form.
        $postId = $request->request->get('post_id');
        if (!$postId) {
            throw $this->createNotFoundException('No post id provided.');
        }

        // Retrieve the post entity from the database.
        $post = $postRepository->find($postId);
        if (!$post) {
            throw $this->createNotFoundException('Post not found.');
        }

        // Create a new Comment and bind the request to the form.
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        // If the form is valid, associate the comment with the post and persist it.
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setPost($post);
            $entityManager->persist($comment);
            $entityManager->flush();
        }

        // Redirect back to the homepage after submission.
        return $this->redirectToRoute('app_home');
    }

    #[Route('/{id}/add-tag', name: 'app_post_add_tag', methods: ['POST'])]
    public function addTag(Request $request, Post $post, EntityManagerInterface $entityManager): Response
    {
        $tagId = $request->request->get('tag_id');
        if ($tagId) {
            $tag = $entityManager->getRepository(Tag::class)->find($tagId);
            if ($tag) {
                $post->addTag($tag);
                $entityManager->flush();
            }
        }

        return $this->redirectToRoute('app_post_show', ['id' => $post->getId()]);
    }

    // Remove a tag from a post
    #[Route('/{postId}/remove-tag/{tagId}', name: 'app_remove_tag', methods: ['POST'])]
    public function removeTagFromPost(int $postId, int $tagId, EntityManagerInterface $entityManager, PostRepository $postRepository): Response
    {
        // Find the post
        $post = $postRepository->find($postId);
        if (!$post) {
            throw $this->createNotFoundException('Post not found');
        }
    
        // Find the tag to be removed
        $tag = $entityManager->getRepository(Tag::class)->find($tagId);
        if (!$tag) {
            throw $this->createNotFoundException('Tag not found');
        }
    
        // Remove the tag from the post
        $post->removeTag($tag);
        $entityManager->flush();
    
        // Redirect back to the post page or post list
        return $this->redirectToRoute('app_post_show', ['id' => $postId]);
    }

}