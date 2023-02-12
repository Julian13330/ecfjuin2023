<?php

namespace App\DataFixtures;

use App\DataFixtures\CategoryFixtures;
use App\Entity\Meal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MealFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Les entrées
         $soupe = new Meal();
         $soupe->setTitle('La soupe de poissons');
         $soupe->setDescription('Croutons,rouille,emmental et gousse d\'ail');
         $soupe->setImageName('');
         $soupe->setPrice(14,00);
         // getReference qui me permet d'ajouter la catégorie à mon plat.
         $soupe->setCategory($this->getReference(CategoryFixtures::CATEGORY_ENTREE));
         $manager->persist($soupe);

         // Les plats mer

         $dorade = new Meal();
         $dorade->setTitle('Le filet de Dorade');
         $dorade->setDescription('Risotto aux champignons, sauces aux girolles et au foie gras');
         $dorade->setPrice(32,00);
         $dorade->setImageName('');
         // getReference qui me permet d'ajouter la catégorie à mon plat.
         $dorade->setCategory($this->getReference(CategoryFixtures::CATEGORY_MER));
         $manager->persist($dorade);

         // Les plats terre
         $entrecôte = new Meal();
         $entrecôte->setTitle('Entrecôte grillée');
         $entrecôte->setDescription('Entrecôte race Limousine, environ 260 grammes');
         $entrecôte->setImageName('');
         $entrecôte->setPrice(26,00);
         // getReference qui me permet d'ajouter la catégorie à mon plat.
         $entrecôte->setCategory($this->getReference(CategoryFixtures::CATEGORY_TERRE));
         $manager->persist($entrecôte);

         // Les desserts
         $chocolat = new Meal();
         $chocolat->setTitle('Mousse au chocolat');
         $chocolat->setDescription('Mousse au chocolat fait maison, glace vanille');
         $chocolat->setImageName('');
         $chocolat->setPrice(10,00);
         // getReference qui me permet d'ajouter la catégorie à mon plat.
         $chocolat->setCategory($this->getReference(CategoryFixtures::CATEGORY_DESSERT));
         $manager->persist($chocolat);


        $manager->flush();
    }
}
