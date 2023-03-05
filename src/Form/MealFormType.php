<?php

namespace App\Form;

use App\Entity\Meal;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class MealFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', options:[
                'label' => 'Nom du plat'
            ])
            ->add('description')
            ->add('price', options:[
                'label' => 'prix du plat',
                'attr' => ['min' => 1, 'max' => 40]
            ])
           // ->add('users')
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'label' => 'catégorie du plat',
                'choice_label' => 'title'
            ])
            ->add('favoris', options: [
                'label' => 'Voulez-vous afficher le plat ?'
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'image du plat',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Meal::class,
        ]);
    }
}
