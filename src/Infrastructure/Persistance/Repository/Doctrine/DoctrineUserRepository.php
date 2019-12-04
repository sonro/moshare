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
        return $this->entityManager->createQueryBuilder()
            ->select('user, portfolios')
            ->from(self::ENTITY, 'user')
            ->join('user.portfolios', 'portfolios')
            ->where('user.email=:email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();
        // return $this->doctrineRepository->findOneBy(['email' => $email]);
    }
}
