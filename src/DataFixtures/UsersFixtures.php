<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker;

class UsersFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordEncoder
        ){}

    public function load(ObjectManager $manager): void
    {
        $admin = new Users();
        $admin->setEmail('admin@demo.fr');
        $admin->setUsername('helloJul');
        $admin->setLastname('Babarhume');
        $admin->setFirstname('Jul');
        $admin->setAllergie('Gluten');
        $admin->setPassword(
        $this->passwordEncoder->hashPassword($admin, 'admin')
        );
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        $faker = Faker\Factory::create('fr_FR');

        for($usr = 1; $usr <= 5; $usr++){
            $user = new Users();
            $user->setEmail($faker->email);
            $user->setUsername($faker->username);
            $user->setLastname($faker->lastname);
            $user->setFirstname($faker->firstname);
            $user->setAllergie('Gluten');
            $user->setUserGuest($faker->randomNumber(1));
            $user->setPassword(
            $this->passwordEncoder->hashPassword($user, 'secret')
        );
        $manager->persist($user);
        }


        $manager->flush();
    }
}
