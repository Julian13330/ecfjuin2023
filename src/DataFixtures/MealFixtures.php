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
         $accra = new Meal();
         $accra->setTitle('Accras de Morue');
         $accra->setDescription('La recette familiale en provenance du Portugal');
         $accra->setImageName('');
         $accra->setPrice(14,00);
         // getReference qui me permet d'ajouter la catégorie à mon plat.
         $accra->setCategory($this->getReference(CategoryFixtures::CATEGORY_ENTREE));
         $manager->persist($accra);

         $panisse = new Meal();
         $panisse->setTitle('Panisses marseillaises');
         $panisse->setDescription('Recette locale, végétarienne et sans gluten !');
         $panisse->setImageName('');
         $panisse->setPrice(12,00);
         // getReference qui me permet d'ajouter la catégorie à mon plat.
         $panisse->setCategory($this->getReference(CategoryFixtures::CATEGORY_ENTREE));
         $manager->persist($panisse);

         $soupe = new Meal();
         $soupe->setTitle('La soupe de poissons');
         $soupe->setDescription('Croutons,rouille,emmental et gousse d\'ail');
         $soupe->setImageName('');
         $soupe->setPrice(14,00);
         // getReference qui me permet d'ajouter la catégorie à mon plat.
         $soupe->setCategory($this->getReference(CategoryFixtures::CATEGORY_ENTREE));
         $manager->persist($soupe);

         // Les plats mer
         $homard = new Meal();
         $homard->setTitle('Les ravioles de Homard');
         $homard->setDescription('Pâte à raviole à l\'encre de seiches,sauce au beurre ');
         $homard->setImageName('');
         $homard->setPrice(36,00);
         // getReference qui me permet d'ajouter la catégorie à mon plat.
         $homard->setCategory($this->getReference(CategoryFixtures::CATEGORY_MER));
         $manager->persist($homard);

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

         $raviole = new Meal();
         $raviole->setTitle('Les ravioles cèpes et foie gras');
         $raviole->setDescription('Pâte fraiche parfumée à la truffe, bouillon forestier');
         $raviole->setImageName('');
         $raviole->setPrice(29,00);
         // getReference qui me permet d'ajouter la catégorie à mon plat.
         $raviole->setCategory($this->getReference(CategoryFixtures::CATEGORY_TERRE));
         $manager->persist($raviole);

         // Les desserts
         $chocolat = new Meal();
         $chocolat->setTitle('Mousse au chocolat');
         $chocolat->setDescription('Mousse au chocolat fait maison, glace vanille');
         $chocolat->setImageName('');
         $chocolat->setPrice(10,00);
         // getReference qui me permet d'ajouter la catégorie à mon plat.
         $chocolat->setCategory($this->getReference(CategoryFixtures::CATEGORY_DESSERT));
         $manager->persist($chocolat);

         $cafe = new Meal();
         $cafe->setTitle('Café gourmand');
         $cafe->setDescription('Assortiment de trois pâtisseries');
         $cafe->setImageName('');
         $cafe->setPrice(12,00);
         // getReference qui me permet d'ajouter la catégorie à mon plat.
         $cafe->setCategory($this->getReference(CategoryFixtures::CATEGORY_DESSERT));
         $manager->persist($cafe);

        $manager->flush();
    }
}
