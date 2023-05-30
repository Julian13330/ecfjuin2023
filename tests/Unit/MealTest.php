<?php

namespace App\Tests;

use App\Entity\Meal;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MealTest extends KernelTestCase
{
    public function getEntity(): Meal
    {
        return (new Meal())->setDescription('Description #1')
            ->setTitle('Title #1')
            ->setPrice(10);
    }

    public function testEntityIsValid(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $meal = $this->getEntity();

        $errors = $container->get('validator')->validate($meal);

        // On attends 0 erreur, sinon c'est en erreur
        $this->assertCount(0, $errors);

    }
}
