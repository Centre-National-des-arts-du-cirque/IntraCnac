<?php

namespace App\DataFixtures;

use App\Factory\EventFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
class EventFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        EventFactory::createOne(['dateBeg'=>date_create('2023-10-23 11:00:00'),'dateEnd'=>date_create('2023-10-23 14:00:00'),'lib'=>'repas equipe']);
        EventFactory::createOne(['dateBeg'=>date_create('2023-10-23 9:00:00'),'dateEnd'=>date_create('2023-10-23 10:00:00'),'lib'=>'reunion equipe']);
        EventFactory::createOne(['dateBeg'=>date_create('2023-10-25 9:00:00'),'dateEnd'=>date_create('2023-10-25 18:00:00'),'lib'=>'Microsoft 365 ']);
    }
    public function getDependencies(): array
    {
        return [
            TypeEventFixtures::class,
        ];
    }
}
