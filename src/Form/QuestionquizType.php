<?php

namespace App\Form;

use App\Entity\Questionquiz;
use App\Entity\Quiz;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionquizType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id_quiz')
            ->add('question')
            ->add('type_question')
            ->add('option_1')
            ->add('option_2')
            ->add('option_3')
            ->add('option_4')
            ->add('bonne_reponse')
            ->add('explication')
            ->add('date_creation', null, [
                'widget' => 'single_text',
            ])
            ->add('quiz', EntityType::class, [
                'class' => Quiz::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Questionquiz::class,
        ]);
    }
}
