<?php

namespace App\Tests;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class EntityTestCase extends KernelTestCase
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    protected function setUp(): void
    {
        self::bootKernel();
        $entityManager = self::$container->get('doctrine')->getManager();
        $this->entityManager = $entityManager;
    }

    protected function tearDown(): void
    {
        $this->entityManager->close();
        $this->entityManager = null;
        parent::tearDown();
    }
}
