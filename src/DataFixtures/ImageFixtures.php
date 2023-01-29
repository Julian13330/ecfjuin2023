<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ImageFixtures extends Fixture
{
    public const IMAGE_ENTREE = 'entrée_image';
    public const IMAGE_MER = 'mer_image';
    public const IMAGE_TERRE = 'terre_image';
    public const IMAGE_DESSERT = 'dessert_image';
    

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

         $entrée = new Image();
         $entrée->setTitle($faker->image(null, 640, 480));
         $manager->persist($entrée);
        
         $mer = new Image();
         $mer->setTitle($faker->image(null, 640, 480));
         $manager->persist($mer);

         $terre = new Image();
         $terre->setTitle($faker->image(null, 640, 480));
         $manager->persist($terre);

         $dessert = new Image();
         $dessert->setTitle($faker->image(null, 640, 480));
         $manager->persist($dessert);

        $manager->flush();
        // J'ajoute mes références pour pouvoir les relier dans mes plats.
        $this->addReference(self::IMAGE_ENTREE, $entrée);
        $this->addReference(self::IMAGE_MER, $mer);
        $this->addReference(self::IMAGE_TERRE, $terre);
        $this->addReference(self::IMAGE_DESSERT, $dessert);
    }
}
