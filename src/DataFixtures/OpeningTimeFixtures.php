<?php

namespace App\DataFixtures;

use App\Entity\OpeningTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OpeningTimeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Afficher les horaires de la semaine
        // lundi
        $lundi = new OpeningTime();
        $lundi->setDay("lundi");
        $lundi->setOpenSoon(new \DateTime('12:00:00'));
        $lundi->setCloseSoon(new \DateTime('14:00:00'));
        $lundi->setOpenNight(new \DateTime('18:00:00'));
        $lundi->setCloseNight(new \DateTime('23:00:00'));
        $lundi->setOpen(false);

        $manager->persist($lundi);

        $mardi = new OpeningTime();
        $mardi->setDay("mardi");
        $mardi->setOpenSoon(new \DateTime('12:00:00'));
        $mardi->setCloseSoon(new \DateTime('14:00:00'));
        $mardi->setOpenNight(new \DateTime('18:00:00'));
        $mardi->setCloseNight(new \DateTime('23:00:00'));
        $mardi->setOpen(true);

        $manager->persist($mardi);

        $mercredi = new OpeningTime();
        $mercredi->setDay("mercredi");
        $mercredi->setOpenSoon(new \DateTime('12:00:00'));
        $mercredi->setCloseSoon(new \DateTime('14:00:00'));
        $mercredi->setOpenNight(new \DateTime('18:00:00'));
        $mercredi->setCloseNight(new \DateTime('23:00:00'));
        $mercredi->setOpen(true);

        $manager->persist($mercredi);

        $jeudi = new OpeningTime();
        $jeudi->setDay("jeudi");
        $jeudi->setOpenSoon(new \DateTime('12:00:00'));
        $jeudi->setCloseSoon(new \DateTime('14:00:00'));
        $jeudi->setOpenNight(new \DateTime('18:00:00'));
        $jeudi->setCloseNight(new \DateTime('23:00:00'));
        $jeudi->setOpen(true);

        $manager->persist($jeudi);

        $vendredi = new OpeningTime();
        $vendredi->setDay("vendredi");
        $vendredi->setOpenSoon(new \DateTime('12:00:00'));
        $vendredi->setCloseSoon(new \DateTime('14:00:00'));
        $vendredi->setOpenNight(new \DateTime('18:00:00'));
        $vendredi->setCloseNight(new \DateTime('23:00:00'));
        $vendredi->setOpen(true);

        $manager->persist($vendredi);

        $samedi = new OpeningTime();
        $samedi->setDay("samedi");
        $samedi->setOpenSoon(new \DateTime('12:00:00'));
        $samedi->setCloseSoon(new \DateTime('14:00:00'));
        $samedi->setOpenNight(new \DateTime('18:00:00'));
        $samedi->setCloseNight(new \DateTime('23:00:00'));
        $samedi->setOpen(true);

        $manager->persist($samedi);

        $dimanche = new OpeningTime();
        $dimanche->setDay("dimanche");
        $dimanche->setOpenSoon(new \DateTime('12:00:00'));
        $dimanche->setCloseSoon(new \DateTime('14:00:00'));
        $dimanche->setOpenNight(new \DateTime('18:00:00'));
        $dimanche->setCloseNight(new \DateTime('23:00:00'));
        $dimanche->setOpen(true);

        $manager->persist($dimanche);

        $manager->flush();
    }
}
