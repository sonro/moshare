<?php

namespace App\Infrastructure\Persistance\Repository\Doctrine;

use App\Core\Domain\Model\Account\Account;
use App\Core\Domain\Repository\AccountRepositoryInterface;
use App\Infrastructure\Persistance\Repository\Doctrine\Common\DoctrineEntityRepositoryTrait;

final class DoctrineAccountRepository implements AccountRepositoryInterface
{
    use DoctrineEntityRepositoryTrait;

    public function findOne(int $id): ?Account
    {
        return $this->doctrineRepository->find($id);
    }

    public function findOneByName(string $name): ?Account
    {
        return $this->doctrineRepository->findOneBy(['name' => $name]);
    }
}
