<?php

namespace App\Infrastructure\Persistance\Repository\Doctrine;

use App\Core\Domain\Model\Transaction\Transaction;
use App\Core\Domain\Repository\TransactionRepositoryInterface;
use App\Infrastructure\Persistance\Repository\Doctrine\Common\DoctrineEntityRepositoryTrait;

final class DoctrineTransactionRepository implements TransactionRepositoryInterface
{
    use DoctrineEntityRepositoryTrait;

    public function findOne(int $id): ?Transaction
    {
        return $this->doctrineRepository->find($id);
    }

    public function findOneByTitle(string $title): ?Transaction
    {
        return $this->doctrineRepository->findOneBy(['title' => $title]);
    }
}
