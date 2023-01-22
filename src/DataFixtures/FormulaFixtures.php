<?php

namespace App\DataFixtures;

use App\DataFixtures\MenuFixtures;
use App\Entity\Formula;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FormulaFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // La formule du petit moussaillon
        $petitmoussaillon= new Formula();
        $petitmoussaillon->setTitle('Formule du petit moussaillon');
        $petitmoussaillon->setDescription('Formule repas pour les petits gourmands');
        $petitmoussaillon->setPrice(10,00);
        // getReference qui me permet d'ajouter la catégorie à mon plat.
        $petitmoussaillon->setMenu($this->getReference(MenuFixtures::MENU_MOUSSAILLON));
        $manager->persist($petitmoussaillon);

        // La formule du grand moussaillon
        $grandmoussaillon= new Formula();
        $grandmoussaillon->setTitle('Formule du grand moussaillon');
        $grandmoussaillon->setDescription('Formule repas pour les petits mais grands gourmands');
        $grandmoussaillon->setPrice(14,00);
        // getReference qui me permet d'ajouter la catégorie à mon plat.
        $grandmoussaillon->setMenu($this->getReference(MenuFixtures::MENU_MOUSSAILLON));
        $manager->persist($grandmoussaillon);

        // La formule déjeuner
        $déjeuner= new Formula();
        $déjeuner->setTitle('Formule déjeuner');
        $déjeuner->setDescription('Repas du midi');
        $déjeuner->setPrice(18,00);
        // getReference qui me permet d'ajouter la catégorie à mon plat.
        $déjeuner->setMenu($this->getReference(MenuFixtures::MENU_PLAISIR));
        $manager->persist($déjeuner);

        // La formule diner
        $diner= new Formula();
        $diner->setTitle('Formule diner');
        $diner->setDescription('Repas du soir');
        $diner->setPrice(24,00);
        // getReference qui me permet d'ajouter la catégorie à mon plat.
        $diner->setMenu($this->getReference(MenuFixtures::MENU_PLAISIR));
        $manager->persist($diner);

        $manager->flush();
    }

    // intégrer dans mes fixtures load d'abord MenuFixtures, pour faire passer mes données de FormulaFixtures.
    public function getDependencies(): array
    {
        return [
            MenuFixtures::class
        ];
    }
}
