<?php

namespace App\Core\Domain\Repository;

use App\Core\Domain\Model\Transaction\Transactor;

interface TransactorRepositoryInterface extends EntityRepositoryInterface
{
    const ENTITY = Transactor::class;

    public function findOne(int $id): ?Transactor;

    public function findOneByName(string $name): ?Transactor;

    public function add(Transactor $user): void;

    public function remove(Transactor $user): void;
}
