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
         $lundi->setHourIn(new \DateTime('18:00:00'));
         $lundi->setHourOut(new \DateTime('23:00:00'));

         $manager->persist($lundi);

         $mardi = new OpeningTime();
         $mardi->setDay("mardi");
         $mardi->setHourIn(new \DateTime('18:00:00'));
         $mardi->setHourOut(new \DateTime('23:00:00'));

         $manager->persist($mardi);

         $mercredi = new OpeningTime();
         $mercredi->setDay("mercredi");
         $mercredi->setHourIn(new \DateTime('18:00:00'));
         $mercredi->setHourOut(new \DateTime('23:00:00'));

         $manager->persist($mercredi);

         $jeudi = new OpeningTime();
         $jeudi->setDay("jeudi");
         $jeudi->setHourIn(new \DateTime('18:00:00'));
         $jeudi->setHourOut(new \DateTime('23:00:00'));

         $manager->persist($jeudi);

         $vendredi = new OpeningTime();
         $vendredi->setDay("vendredi");
         $vendredi->setHourIn(new \DateTime('18:00:00'));
         $vendredi->setHourOut(new \DateTime('23:00:00'));

         $manager->persist($vendredi);

         $samedi = new OpeningTime();
         $samedi->setDay("samedi");
         $samedi->setHourIn(new \DateTime('18:00:00'));
         $samedi->setHourOut(new \DateTime('23:00:00'));

         $manager->persist($samedi);

         $dimanche = new OpeningTime();
         $dimanche->setDay("dimanche");
         $dimanche->setHourIn(new \DateTime('18:00:00'));
         $dimanche->setHourOut(new \DateTime('23:00:00'));

         $manager->persist($dimanche);

        $manager->flush();
    }
}
