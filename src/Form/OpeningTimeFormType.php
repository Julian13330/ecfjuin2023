<?php

namespace App\Form;

use App\Entity\OpeningTime;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
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
            ->add('hour_in',TimeType::class,[
                'input' => 'datetime',
                'widget' => 'choice',
                'label' => 'indiquez l\'heure d\'ouverture'
            ])
            ->add('open', options: [
                'label' => 'Ouvert ce jour ?'
            ])
            ->add('hour_out',TimeType::class,[
                'input' => 'datetime',
                'widget' => 'choice',
                'label' => 'indiquez l\'heure de fermeture'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OpeningTime::class,
        ]);
    }
}
