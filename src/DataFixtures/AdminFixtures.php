<?php

namespace App\DataFixtures;

use App\Factory\AdminFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\UserFactory;

class AdminFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        AdminFactory::createOne(['name'=>'Patricia','lastname'=>'Hardy','email'=>'technique@cnac.fr','service'=>'Technique']);
        AdminFactory::createOne(['name'=>'Marcello','lastname'=>'Parisse','email'=>'marcello.parisse@cnac.fr','service'=>'Technique']);
        AdminFactory::createOne(['name'=>'Assistance','lastname'=>'Informatique','email'=>'assistance.informatique@cnac.fr','service'=>'Technique']);
    
    }
}
