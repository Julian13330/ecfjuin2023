<?php

namespace App\DataFixtures;

use App\Entity\SeatMax;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SeatMaxFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $maxSeat = new SeatMax();
         $maxSeat ->setNbrSeatMax(20);
         $manager->persist($maxSeat);

        $manager->flush();
    }
}
