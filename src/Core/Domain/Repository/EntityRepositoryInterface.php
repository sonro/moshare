<?php

namespace App\Core\Domain\Repository;

interface EntityRepositoryInterface
{
    public function findAll(): array;

    public function size(): int;
}
