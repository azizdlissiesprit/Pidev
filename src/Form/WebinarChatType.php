<?php

namespace App\Form;

use App\Entity\user;
use App\Entity\webinar;
use App\Entity\WebinarChat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WebinarChatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('message')
            ->add('send_at', null, [
                'widget' => 'single_text',
            ])
            ->add('webinar', EntityType::class, [
                'class' => webinar::class,
                'choice_label' => 'id',
            ])
            ->add('user', EntityType::class, [
                'class' => user::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => WebinarChat::class,
        ]);
    }
}
