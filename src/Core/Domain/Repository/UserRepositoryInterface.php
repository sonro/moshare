<?php

namespace App\Core\Domain\Repository;

use App\Core\Domain\Model\User\User;

interface UserRepositoryInterface extends EntityRepositoryInterface
{
    const ENTITY = User::class;

    public function findOne(int $id): ?User;

    public function findOneByEmail(string $email): ?User;

    public function add(User $user): void;

    public function remove(User $user): void;
}
