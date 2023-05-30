<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const CATEGORY_ENTREE = 'entrée_category';
    public const CATEGORY_MER = 'mer_category';
    public const CATEGORY_TERRE = 'terre_category';
    public const CATEGORY_DESSERT = 'dessert_category';

    public function load(ObjectManager $manager): void
    {
        $entrée = new Category();
        $entrée->setTitle('Les entrées');
        $manager->persist($entrée);
        
        $mer = new Category();
        $mer->setTitle('Les plats mer');
        $manager->persist($mer);

        $terre = new Category();
        $terre->setTitle('Les plats terre');
        $manager->persist($terre);

        $dessert = new Category();
        $dessert->setTitle('Les desserts');
        $manager->persist($dessert);

        $manager->flush();

        // J'ajoute mes références pour pouvoir les relier dans mes plats.
        $this->addReference(self::CATEGORY_ENTREE, $entrée);
        $this->addReference(self::CATEGORY_MER, $mer);
        $this->addReference(self::CATEGORY_TERRE, $terre);
        $this->addReference(self::CATEGORY_DESSERT, $dessert);

    }
}
