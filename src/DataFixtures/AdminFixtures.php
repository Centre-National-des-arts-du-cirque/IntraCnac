<?php

namespace App\DataFixtures;

use App\Factory\AdminFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AdminFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        AdminFactory::createOne(['name' => 'Patricia', 'lastname' => 'Hardy', 'email' => 'technique@cnac.fr', 'service' => 'Technique', 'post' => 'Chargé d administration']);
        AdminFactory::createOne(['name' => 'Marcello', 'lastname' => 'Parisse', 'email' => 'marcello.parisse@cnac.fr', 'service' => 'Technique', 'roles' => ['ROLE_SUPER_ADMIN'], 'post' => 'Directeur technique']);
        AdminFactory::createOne(['name' => 'Assistance', 'lastname' => 'Informatique', 'email' => 'assistance.informatique@cnac.fr', 'service' => 'Technique', 'roles' => ['ROLE_SUPER_ADMIN'], 'post' => 'alternant informatique']);
        AdminFactory::createOne(['name' => 'Claire', 'lastname' => 'Rossi', 'email' => 'claire.rossi@cnac.fr', 'service' => 'Communication', 'roles' => ['ROLE_ADMIN_EVENT'], 'post' => 'Responsable de communication']);
    }
}
