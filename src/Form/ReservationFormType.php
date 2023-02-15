<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class, ['label' => 'Nom de la réservation'])
            ->add('time',DateType::class, [
                    'label' => 'Date',
                    'model_timezone' => 'Europe/Paris',
                    'data' => new \DateTime(),
            ])
            ->add('hour', TimeType::class,
            [
                'label' => 'Heure',
                'input_format' => 'H:m',
                'input'  => 'datetime',
                'widget' => 'choice',
                'hours' => ['12', '13', '14', '19', '20', '21'],
                'minutes' => ['00', '15','30','45']
            ]
        )
            ->add('nbrguest', IntegerType::class, ['label' => 'Nombre de personnes', 'attr' => ['min' => 1, 'max' => 20]])
            ->add('meal_allergy',TextType::class, [
                'required' => false,
                'label' => 'Avez-vous des allergies alimentaires ?'
                ])
           // ->add('users')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
