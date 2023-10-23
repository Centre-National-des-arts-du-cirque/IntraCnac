<?php

namespace App\DataFixtures;

use App\Factory\TypeEventFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;

use Doctrine\Persistence\ObjectManager;

class TypeEventFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $TypeFile = file_get_contents(__DIR__.'/data/TypeEvent.json',true);
        $TypeData = json_decode($TypeFile,true);
        foreach($TypeData as $Type){
            TypeEventFactory::createOne(['lib'=>$Type['lib'] , 'CalendarColor'=> $Type['CalendarColor']]);
        }
    }
}
