<?php

namespace App\DataFixtures;

use App\DataFixtures\CategoryFixtures;
use App\DataFixtures\ImageFixtures;
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
         $accra->setPrice(14,00);
         $accra->setPhoto('C:\Users\julia\AppData\Local\Temp\0b9ba2f85a1c96cb3a09d851a0c80173.png');
         // getReference qui me permet d'ajouter la catégorie à mon plat.
         $accra->setCategory($this->getReference(CategoryFixtures::CATEGORY_ENTREE));
         $accra->addImage($this->getReference(ImageFixtures::IMAGE_ENTREE));
         $manager->persist($accra);

         $panisse = new Meal();
         $panisse->setTitle('Panisses marseillaises');
         $panisse->setDescription('Recette locale, végétarienne et sans gluten !');
         $panisse->setPrice(12,00);
         $panisse->setPhoto('C:\Users\julia\AppData\Local\Temp\872c60c949dcba81300fbeb5e77debe0.png');
         // getReference qui me permet d'ajouter la catégorie à mon plat.
         $panisse->setCategory($this->getReference(CategoryFixtures::CATEGORY_ENTREE));
         $panisse->addImage($this->getReference(ImageFixtures::IMAGE_ENTREE));
         $manager->persist($panisse);

         $soupe = new Meal();
         $soupe->setTitle('La soupe de poissons');
         $soupe->setDescription('Croutons,rouille,emmental et gousse d\'ail');
         $soupe->setPrice(14,00);
         $soupe->setPhoto('C:\Users\julia\AppData\Local\Temp\bc24b1df06d7ac0b98380b31e0c0a53f.png');
         // getReference qui me permet d'ajouter la catégorie à mon plat.
         $soupe->setCategory($this->getReference(CategoryFixtures::CATEGORY_ENTREE));
         $soupe->addImage($this->getReference(ImageFixtures::IMAGE_ENTREE));
         $manager->persist($soupe);

         // Les plats mer
         $homard = new Meal();
         $homard->setTitle('Les ravioles de Homard');
         $homard->setDescription('Pâte à raviole à l\'encre de seiches,sauce au beurre ');
         $homard->setPrice(36,00);
         $homard->setPhoto('C:\Users\julia\AppData\Local\Temp\1359520a45e2b80b73f4aed9b9c71b62.png');
         // getReference qui me permet d'ajouter la catégorie à mon plat.
         $homard->setCategory($this->getReference(CategoryFixtures::CATEGORY_MER));
         $homard->addImage($this->getReference(ImageFixtures::IMAGE_MER));
         $manager->persist($homard);

         $dorade = new Meal();
         $dorade->setTitle('Le filet de Dorade');
         $dorade->setDescription('Risotto aux champignons, sauces aux girolles et au foie gras');
         $dorade->setPrice(32,00);
         $dorade->setPhoto('https://pixabay.com/fr/photos/fruits-de-mer-homard-boston-homard-4265994/');
         // getReference qui me permet d'ajouter la catégorie à mon plat.
         $dorade->setCategory($this->getReference(CategoryFixtures::CATEGORY_MER));
         $dorade->addImage($this->getReference(ImageFixtures::IMAGE_MER));
         $manager->persist($dorade);

         // Les plats terre
         $entrecôte = new Meal();
         $entrecôte->setTitle('Entrecôte grillée');
         $entrecôte->setDescription('Entrecôte race Limousine, environ 260 grammes');
         $entrecôte->setPrice(26,00);
         $entrecôte->setPhoto('');
         // getReference qui me permet d'ajouter la catégorie à mon plat.
         $entrecôte->setCategory($this->getReference(CategoryFixtures::CATEGORY_TERRE));
         $entrecôte->addImage($this->getReference(ImageFixtures::IMAGE_TERRE));
         $manager->persist($entrecôte);

         $raviole = new Meal();
         $raviole->setTitle('Les ravioles cèpes et foie gras');
         $raviole->setDescription('Pâte fraiche parfumée à la truffe, bouillon forestier');
         $raviole->setPrice(29,00);
         $raviole->setPhoto('');
         // getReference qui me permet d'ajouter la catégorie à mon plat.
         $raviole->setCategory($this->getReference(CategoryFixtures::CATEGORY_TERRE));
         $raviole->addImage($this->getReference(ImageFixtures::IMAGE_TERRE));
         $manager->persist($raviole);

         // Les desserts
         $chocolat = new Meal();
         $chocolat->setTitle('Mousse au chocolat');
         $chocolat->setDescription('Mousse au chocolat fait maison, glace vanille');
         $chocolat->setPrice(10,00);
         $chocolat->setPhoto('');
         // getReference qui me permet d'ajouter la catégorie à mon plat.
         $chocolat->setCategory($this->getReference(CategoryFixtures::CATEGORY_DESSERT));
         $chocolat->addImage($this->getReference(ImageFixtures::IMAGE_DESSERT));
         $manager->persist($chocolat);

         $cafe = new Meal();
         $cafe->setTitle('Café gourmand');
         $cafe->setDescription('Assortiment de trois pâtisseries');
         $cafe->setPrice(12,00);
         $cafe->setPhoto('');
         // getReference qui me permet d'ajouter la catégorie à mon plat.
         $cafe->setCategory($this->getReference(CategoryFixtures::CATEGORY_DESSERT));
         $cafe->addImage($this->getReference(ImageFixtures::IMAGE_DESSERT));
         $manager->persist($cafe);

        $manager->flush();
    }
}
