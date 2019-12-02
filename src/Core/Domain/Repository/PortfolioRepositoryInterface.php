<?php

namespace App\Core\Domain\Repository;

use App\Core\Domain\Model\Portfolio\Portfolio;

interface PortfolioRepositoryInterface extends EntityRepositoryInterface
{
    const ENTITY = Portfolio::class;

    public function findOne(int $id): ?Portfolio;

    public function findOneByName(string $name): ?Portfolio;

    public function add(Portfolio $user): void;

    public function remove(Portfolio $user): void;
}
