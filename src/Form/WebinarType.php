<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Webinar;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WebinarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('debut', null, [
                'widget' => 'single_text',
            ])
            ->add('duration')
            ->add('category')
            ->add('tags')
            ->add('registration_required')
            ->add('max_attendees')
            ->add('platform')
            ->add('lien')
            ->add('recording_avaible')
            ->add('presenter', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Webinar::class,
        ]);
    }
}