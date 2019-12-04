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

    public function testFindOneByEmail()
    {
        $email = 'test.name.one@example.com';
        $user = $this->repository->findOneByEmail($email);
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($email, $user->getEmail());
    }

    public function testFindOne()
    {
        $email = 'test.name.one@example.com';
        $user = $this->repository->findOneByEmail($email);
        $this->assertEquals($email, $user->getEmail());
        $id = $user->getId();

        $result = $this->repository->findOne($id);
        $this->assertEquals($user, $result);
    }

    public function testAdd()
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

    public function testRemove()
    {
        $email = 'test.name.one@example.com';
        $user = $this->repository->findOneByEmail($email);
        $this->assertEquals($email, $user->getEmail());

        $this->repository->remove($user);
        $this->entityManager->flush();

        $user = $this->repository->findOneByEmail($email);
        $this->assertNull($user);
    }

    public function testFindAll()
    {
        $result = $this->repository->findAll();
        $this->assertNotEmpty($result);
        $this->assertInstanceOf(User::class, $result[0]);
    }

    public function testSize()
    {
        $result = $this->repository->size();
        $this->assertGreaterThan(0, $result);

        $user = new User();
        $user->setActive(false);
        $user->setEmail('test@example.com');
        $user->setFirstname('Test');
        $user->setLastname('Name');
        $user->setPassword('password');
        $this->repository->add($user);
        $this->entityManager->flush();

        $newResult = $this->repository->size();
        $this->assertEquals($result + 1, $newResult);
    }
}
