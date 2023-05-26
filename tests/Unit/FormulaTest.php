<?php

namespace App\Tests\Unit;

use App\Entity\Formula;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class FormulaTest extends KernelTestCase
{
    public function getEntity(): Formula
    {
        return (new Formula())->setDescription('Description #1')
            ->setTitle('Title #1');
    }

    public function testEntityIsValid(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $formula = $this->getEntity();

        $errors = $container->get('validator')->validate($formula);

        // On attends 0 erreur, sinon c'est en erreur
        $this->assertCount(0, $errors);

    }

    public function testInvalidTitle()
    {
        self::bootKernel();
        $container = static::getContainer();

        $formula = $this->getEntity();
        $formula->setTitle(10);

        $errors = $container->get('validator')->validate($formula);

        // On attends 1 erreur, sinon c'est en erreur
        $this->assertCount(0, $errors);
    }
}
