<?php

namespace App\Tests;

use App\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ReservationTest extends KernelTestCase
{
    public function getEntity(): Reservation
    {
        return (new Reservation())->setName('James')
            ->setNbrGuest(3)
            ->setMealAllergy('crustacé')
            ->setHour(new \DateTimeImmutable());
    }

    public function testEntityIsValid(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $reservation = $this->getEntity();

        $errors = $container->get('validator')->validate($reservation);

        // On attends 0 erreur, sinon c'est en erreur
        $this->assertCount(0, $errors);

    }
}
