<?php
// src/Form/PostType.php

namespace App\Form;

use App\Entity\Post;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Title',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter post title'
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Title cannot be empty']),
                    new Assert\Length(['min' => 3, 'minMessage' => 'Title must be at least {{ limit }} characters long']),
                    new Assert\Regex([
                        'pattern' => '/^[A-Z]/',
                        'message' => 'Title must start with an uppercase letter'
                    ]),
                    new Assert\Regex([
                        'pattern' => '/^[^\.]*$/',
                        'message' => 'Title cannot contain periods (.)'
                    ])
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Content',
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 6,
                    'placeholder' => 'Write your content here...'
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Content cannot be empty']),
                    new Assert\Regex([
                        'pattern' => '/^[A-Z]/',
                        'message' => 'Content must start with an uppercase letter'
                    ])
                
                ]
                
            ])

            ->add('tags', EntityType::class, [
                'class' => Tag::class,
                'choice_label' => 'name',
                'multiple' => true,  // Allow multiple tags to be selected
                'expanded' => false,  // Display as a multi-select dropdown
                'placeholder' => 'Select tags (if any)',
                'required' => false,
                'attr' => ['class' => 'form-control']
            ]);
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}