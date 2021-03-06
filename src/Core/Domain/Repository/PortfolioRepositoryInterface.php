<?php

namespace App\Core\Domain\Repository;

use App\Core\Domain\Model\Portfolio\Portfolio;
use App\Core\Domain\Model\User\User;

interface PortfolioRepositoryInterface extends EntityRepositoryInterface
{
    const ENTITY = Portfolio::class;

    public function findOne(int $id): ?Portfolio;

    public function findOneByName(string $name): ?Portfolio;

    public function findAllByUser(User $user): array;
}
