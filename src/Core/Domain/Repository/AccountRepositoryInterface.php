<?php

namespace App\Core\Domain\Repository;

use App\Core\Domain\Model\Account\Account;

interface AccountRepositoryInterface extends EntityRepositoryInterface
{
    const ENTITY = Account::class;

    public function findOne(int $id): ?Account;

    public function findOneByName(string $name): ?Account;

    public function add(Account $user): void;

    public function remove(Account $user): void;
}
