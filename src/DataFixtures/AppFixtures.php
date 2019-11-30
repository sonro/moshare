<?php

namespace App\DataFixtures;

use App\Core\Domain\Model\User\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setFirstname('Test');
        $user->setLastname('Name');
        $user->setActive(false);
        $user->setEmail('test.name@example.com');
        $user->setPassword('password');
        $manager->persist($user);

        $manager->flush();
    }
}
