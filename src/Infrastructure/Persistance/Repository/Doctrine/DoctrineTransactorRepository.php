<?php

namespace App\Infrastructure\Persistance\Repository\Doctrine;

use App\Core\Domain\Model\Transaction\Transactor;
use App\Core\Domain\Repository\TransactorRepositoryInterface;
use App\Infrastructure\Persistance\Repository\Doctrine\Common\DoctrineEntityRepositoryTrait;

final class DoctrineTransactorRepository implements TransactorRepositoryInterface
{
    use DoctrineEntityRepositoryTrait;

    public function findOne(int $id): ?Transactor
    {
        return $this->doctrineRepository->find($id);
    }

    public function findOneByName(string $name): ?Transactor
    {
        return $this->doctrineRepository->findOneBy(['name' => $name]);
    }
}
