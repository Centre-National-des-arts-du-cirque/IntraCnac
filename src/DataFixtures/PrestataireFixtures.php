<?php

namespace App\DataFixtures;

use App\Factory\PrestataireFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PrestataireFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $TypeFile = file_get_contents(__DIR__.'/data/Provider.json', true);
        $TypeData = json_decode($TypeFile, true);
        foreach ($TypeData as $Type) {
            PrestataireFactory::createOne(['name' => $Type['name'], 'lastname' => $Type['LastName'], 'email' => $Type['email'], 'tel' => $Type['phoneNumber'], 'societyName' => $Type['societyName']]);
        }
    }
}
