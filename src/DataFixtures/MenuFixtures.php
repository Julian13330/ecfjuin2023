<?php

namespace App\DataFixtures;

use App\Entity\Menu;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MenuFixtures extends Fixture
{
    public const MENU_MOUSSAILLON = 'moussaillon_menu';
    public const MENU_PLAISIR = 'plaisir_menu';

    public function load(ObjectManager $manager): void
    {
         $moussaillon = new Menu();
         $moussaillon->setTitle('Menu Moussaillon -10 ans');
         $manager->persist($moussaillon);

         $plaisir = new Menu();
         $plaisir->setTitle('Menu Plaisir');
         $manager->persist($plaisir);

        $manager->flush();

        // J'ajoute mes références pour pouvoir les relier à mes formules
        $this->addReference(self::MENU_MOUSSAILLON, $moussaillon);
        $this->addReference(self::MENU_PLAISIR, $plaisir);

    }
}
