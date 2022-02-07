<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }


    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('michel@gmail.com');
        $user->setRoles(['ROLE_USER']);
        $user->setFirstname('Michel');
        $user->setLastname('Dupont');
        $user->setAge('32');
        $user->setCity('Toulouse');
        $user->setAvatar('https://img.lamontagne.fr/hRXdzX_0rahGmklblgI3-mXEdTSwtp0XmH_5XGBmfiY/fit/657/438/sm/0/bG9jYWw6Ly8vMDAvMDAvMDQvNTYvNDgvMjAwMDAwNDU2NDg5Nw.jpg');
        $user->addSport($this->getReference('sport_0'));
        $user->addActivity($this->getReference('activity_0'));
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            'michelmichel'
        );

        $user->setPassword($hashedPassword);
        $manager->persist($user);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SportFixtures::class,
            ActivityFixtures::class
        ];
    }
}
