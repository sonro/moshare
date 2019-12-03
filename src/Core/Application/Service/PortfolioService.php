<?php

namespace App\Core\Application\Service;

use App\Core\Domain\Model\Portfolio\Portfolio;
use App\Core\Domain\Repository\PortfolioRepositoryInterface;

final class PortfolioService
{
    /**
     * @var PortfolioRepositoryInterface
     */
    private $repository;

    public function __construct(PortfolioRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(string $name, array $users): Portfolio
    {
        $portfolio = new Portfolio();
        $portfolio->setName($name);
        $portfolio->setActive(true);
        foreach ($users as $user) {
            $portfolio->addUser($user);
        }

        $this->repository->add($portfolio);

        return $portfolio;
    }
}
