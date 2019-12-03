<?php

namespace App\Infrastructure\Persistance\Repository\Doctrine;

use App\Core\Domain\Model\Ledger\Ledger;
use App\Core\Domain\Repository\LedgerRepositoryInterface;
use App\Infrastructure\Persistance\Repository\Doctrine\Common\DoctrineEntityRepositoryTrait;

final class DoctrineLedgerRepository implements LedgerRepositoryInterface
{
    use DoctrineEntityRepositoryTrait;

    public function findOne(int $id): ?Ledger
    {
        return $this->doctrineRepository->find($id);
    }

    public function findOneByName(string $name): ?Ledger
    {
        return $this->doctrineRepository->findOneBy(['name' => $name]);
    }
}
