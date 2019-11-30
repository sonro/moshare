<?php

namespace App\Infrastructure\Persistance\Repository\Doctrine;

use App\Core\Domain\Model\User\User;
use App\Core\Domain\Repository\UserRepositoryInterface;
use App\Infrastructure\Persistance\Repository\Doctrine\Common\DoctrineEntityRepositoryTrait;

final class DoctrineUserRepository implements UserRepositoryInterface
{
    use DoctrineEntityRepositoryTrait;

    public function findOne(int $id): ?User
    {
        return $this->doctrineRepository->find($id);
    }

    public function findOneByEmail(string $email): ?User
    {
        return $this->doctrineRepository->findOneBy(['email' => $email]);
    }

    public function add(User $user): void
    {
        $this->entityManager->persist($user);
    }

    public function remove(User $user): void
    {
        $this->entityManager->remove($user);
    }
}
