<?php

namespace App\Integration\Infrastructure\Persistance\Repository\Doctrine;

use App\Core\Domain\Model\User\User;
use App\Infrastructure\Persistance\Repository\Doctrine\DoctrineUserRepository;
use App\Tests\EntityTestCase;

final class DoctrineUserRepositoryTest extends EntityTestCase
{
    /**
     * @var DoctrineUserRepository
     */
    private $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new DoctrineUserRepository($this->entityManager);
    }

    public function testEntity()
    {
        $this->assertEquals(User::class, DoctrineUserRepository::ENTITY);
    }

    public function testNullFindOne()
    {
        $result = $this->repository->findOne(-1234567);
        $this->assertNull($result);
    }

    public function testSave()
    {
        $user = new User();
        $user->setActive(false);
        $user->setEmail('test@example.com');
        $user->setFirstname('Test');
        $user->setLastname('Name');
        $user->setPassword('password');

        $this->assertNull($user->getId());

        $this->repository->add($user);
        $this->entityManager->flush();

        $this->assertIsInt($user->getId());
    }
}
