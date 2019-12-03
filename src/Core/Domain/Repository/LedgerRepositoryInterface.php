<?php

namespace App\Core\Domain\Repository;

use App\Core\Domain\Model\Ledger\Ledger;

interface LedgerRepositoryInterface extends EntityRepositoryInterface
{
    const ENTITY = Ledger::class;

    public function findOne(int $id): ?Ledger;

    public function findOneByName(string $name): ?Ledger;
}
