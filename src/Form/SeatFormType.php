<?php

namespace App\Form;

use App\Entity\SeatMax;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeatMaxFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nbrSeatMax',IntegerType::class, ['label' => 'Nombre de place maximum toutes les heures','attr' => ['min' => 15, 'max' => 150]])
           // ->add('users')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SeatMax::class,
        ]);
    }
}
