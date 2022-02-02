<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class ActivityFixtures extends Fixture implements DependentFixtureInterface
{
    public const ACTIVITIES = [
        [
            'Cherche cycliste pour viré champetre',
            'Bonjour, moi c\'est Michel. Je recherche un compagnon de pédale pour faire quelques dizaines de bornes en vélo.',
            2022-02-15,
            'https://cdn-assets.alltrails.com/fr/static-map/production/at-map/29332230/trail-france-haute-garonne-etangs-de-frouzins-at-map-29332230-1636734296-414x200-2.png',
            4,
            'sport_0',
        ],
        [
            'Veut taper quelques balles',
            'Bonjour, je suis à la recherche d\'un ou d\'une adversaire pour echangerquelques balles sur le cour à Portet. Horaires flexibles.',
            2022-03-23,
            'https://lvdneng.rosselcdn.net/sites/default/files/dpistyles_v2/ena_16_9_extra_big/2021/02/15/node_937135/50481302/public/2021/02/15/B9726145378Z.1_20210215114617_000%2BGKPHJHFD0.2-0.jpg?itok=9uMZrEG-1613385983',
            2,
            'sport_1'
        ],
        [
            'Cherche groupe pour organiser un match',
            ' Boujour, je recherche quelques basketeurs pour faire des matchs le week end dans la bonne humeur !',
            2022-02-13,
            'https://cdn-europe1.lanmedia.fr/var/europe1/storage/images/europe1/sport/basket-a-new-york-les-supporters-americains-craignent-un-peu-la-france-4061079/57498307-1-fre-FR/Basket-a-New-York-les-supporters-americains-craignent-un-peu-la-France.jpg',
            6,
            'sport_2',
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (SELF::ACTIVITIES as $key => $activity){
            $add = new Activity();
            $add->setTitle($activity[0]);
            $add->setDescription($activity[1]);
            $add->setDate(new \DateTime($activity[2]));
            $add->setPicture($activity[3]);
            $add->setCapacity($activity[4]);
            $add->setSport($this->getReference($activity[5]));
            $manager->persist($add);
            $this->addReference('activity_' . $key, $add);
        };
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SportFixtures::class,
        ];
    }
}
