<?php

namespace App\DataFixtures;

use App\Entity\Reservation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ReservationFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $firstResa = new Reservation();
        $firstResa -> setName('Jul');
        $firstResa -> setTime(new \DateTime('10/12/2023'));
        $firstResa -> setHour(new \DateTime('18:00:00'));
        $firstResa -> setNbrGuest(5);
        $firstResa -> setMealAllergy('Poisson');


        $manager->persist($firstResa);

        $manager->flush();
    }
}
