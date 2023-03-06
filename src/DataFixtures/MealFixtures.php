<?php

namespace App\DataFixtures;

use App\DataFixtures\CategoryFixtures;
use App\Entity\Meal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MealFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Les entrées
         $soupe = new Meal();
         $soupe->setTitle('La soupe de poissons');
         $soupe->setDescription('Croutons,rouille,emmental et gousse d\'ail');
         $soupe->setImageName('soupe-de-poisson-63f23c6301355069455382.jpg');
         $soupe->setPrice(14,00);
         $soupe->setFavoris('yes');
         // getReference qui me permet d'ajouter la catégorie à mon plat.
         $soupe->setCategory($this->getReference(CategoryFixtures::CATEGORY_ENTREE));
         $manager->persist($soupe);

         // Les plats mer

         $dorade = new Meal();
         $dorade->setTitle('Le filet de Dorade');
         $dorade->setDescription('Risotto aux champignons, sauces aux girolles et au foie gras');
         $dorade->setPrice(32,00);
         $dorade->setFavoris('yes');
         $dorade->setImageName('fish-g09a112b2e-640-64036e3919e20551056557.jpg');
         // getReference qui me permet d'ajouter la catégorie à mon plat.
         $dorade->setCategory($this->getReference(CategoryFixtures::CATEGORY_MER));
         $manager->persist($dorade);

         // Les plats terre
         $entrecôte = new Meal();
         $entrecôte->setTitle('Entrecôte grillée');
         $entrecôte->setDescription('Entrecôte race Limousine, environ 260 grammes');
         $entrecôte->setImageName('entrecote.jpg');
         $entrecôte->setPrice(26,00);
         $entrecôte->setFavoris('yes');
         // getReference qui me permet d'ajouter la catégorie à mon plat.
         $entrecôte->setCategory($this->getReference(CategoryFixtures::CATEGORY_TERRE));
         $manager->persist($entrecôte);

         // Les desserts
         $chocolat = new Meal();
         $chocolat->setTitle('Mousse au chocolat');
         $chocolat->setDescription('Mousse au chocolat fait maison, glace vanille');
         $chocolat->setImageName('nougat-gb7b4b5723-640-64036e8b71185672639148.jpg');
         $chocolat->setPrice(10,00);
         $chocolat->setFavoris('yes');
         // getReference qui me permet d'ajouter la catégorie à mon plat.
         $chocolat->setCategory($this->getReference(CategoryFixtures::CATEGORY_DESSERT));
         $manager->persist($chocolat);


        $manager->flush();
    }
}
