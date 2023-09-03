<?php

namespace App\DataFixtures;

use App\Factory\ErrorTypeFactory;
use App\Factory\PrestataireFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ErrorTypeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $TypeFile = file_get_contents(__DIR__.'/data/ErrorType.json',true);
        $TypeData = json_decode($TypeFile,true);
        foreach($TypeData as $Type){
            ErrorTypeFactory::createOne(['lib'=>$Type['name'] , 'heldby' => PrestataireFactory::random() ]);
        }
    }
    public function getDependencies(): array
    {
        return [
            PrestataireFixtures::class,
        ];
    }
}
