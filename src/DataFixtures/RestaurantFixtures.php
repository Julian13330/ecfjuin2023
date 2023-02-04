<?php

namespace App\DataFixtures;

use App\Entity\Restaurant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RestaurantFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $QuaiAntiqueLyon = new Restaurant();
         $QuaiAntiqueLyon->setName("Le Quai Antique Lyon");

         $manager->persist($QuaiAntiqueLyon);

        $manager->flush();
    }
}
