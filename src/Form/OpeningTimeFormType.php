<?php

namespace App\Form;

use App\Entity\OpeningTime;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OpeningTimeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('day', TextType::class,[
                'label' => 'journée de la semaine'
            ])
            ->add('hour_in',DateTimeType::class, [
                'format' => 'H:i:s',
                'label' => 'ouverture',
                'widget' => 'choice',
                'hours' => range(0, 23),
                'html5' => false
            ])
            ->add('hour_out', DateTimeType::class, [
                'format' => 'H:i:s',
                'label' => 'fermeture',
                'widget' => 'choice',
                'hours' => range(0, 23),
                'html5' => false
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OpeningTime::class,
        ]);
    }
}
