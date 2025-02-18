<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\Inscriptioncours;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptioncoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateinscription', null, [
                'widget' => 'single_text',
            ])
            ->add('idcours', EntityType::class, [
                'class' => Cours::class,
                'choice_label' => 'id',
            ])
            ->add('iduser', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inscriptioncours::class,
        ]);
    }
}
