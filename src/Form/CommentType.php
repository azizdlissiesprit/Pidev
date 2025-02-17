<?php

// src/Form/CommentType.php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints as Assert;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextareaType::class, [
                'label' => 'Your Comment',
                'attr' => ['class' => 'form-control', 'rows' => 4],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'The comment cannot be blank.',
                    ]),
                    new Assert\Regex([
                        'pattern' => '/^[A-Z]/',
                        'message' => 'The comment must start with an uppercase letter.',
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
