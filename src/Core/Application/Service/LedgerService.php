<?php

namespace App\Core\Application\Service;

use App\Core\Domain\Model\Ledger\Ledger;
use App\Core\Domain\Repository\LedgerRepositoryInterface;

final class LedgerService
{
    /**
     * @var LedgerRepositoryInterface
     */
    private $repository;

    public function __construct(LedgerRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(string $name): Ledger
    {
        $ledger = new Ledger();
        $ledger->setName($name);

        $this->repository->add($ledger);

        return $ledger;
    }
}
