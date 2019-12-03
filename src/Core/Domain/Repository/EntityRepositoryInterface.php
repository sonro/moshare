<?php

namespace App\Core\Domain\Repository;

use App\Core\Domain\Model\Shared\AbstractDomainEntity;

interface EntityRepositoryInterface
{
    public function findAll(): array;

    public function size(): int;

    public function add(AbstractDomainEntity $entity): void;

    public function remove(AbstractDomainEntity $entity): void;
}
