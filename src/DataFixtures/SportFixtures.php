<?php

namespace App\DataFixtures;

use App\Entity\Sport;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class SportFixtures extends Fixture
{
    public const SPORTS = [
        'Velo',
        'Tennis',
        'Foot',
        'Basket',
        'Badminton',
        'Roller',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (SELF::SPORTS as $key => $sport){
            $game = new Sport();
            $game->setName($sport);
            $this->addReference('sport_' . $key, $game);
            $manager->persist($game);
        };
        $manager->flush();
    }
}
