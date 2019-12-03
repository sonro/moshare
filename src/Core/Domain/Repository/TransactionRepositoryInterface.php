<?php

namespace App\Core\Domain\Repository;

use App\Core\Domain\Model\Transaction\Transaction;

interface TransactionRepositoryInterface extends EntityRepositoryInterface
{
    const ENTITY = Transaction::class;

    public function findOne(int $id): ?Transaction;

    public function findOneByTitle(string $title): ?Transaction;

    public function add(Transaction $user): void;

    public function remove(Transaction $user): void;
}
