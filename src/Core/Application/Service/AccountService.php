<?php

namespace App\Core\Application\Service;

use App\Core\Domain\Model\Account\Account;
use App\Core\Domain\Model\Account\Priviledge;
use App\Core\Domain\Model\Ledger\Ledger;
use App\Core\Domain\Model\Portfolio\Portfolio;
use App\Core\Domain\Repository\AccountRepositoryInterface;

final class AccountService
{
    /**
     * @var AccountRepositoryInterface
     */
    private $repository;

    public function __construct(AccountRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(
        string $name,
        Ledger $ledger,
        Portfolio $portfolio,
        ?Priviledge $priviledge = null
    ): Account {
        $account = new Account();
        $account->setName($name);
        $account->setLedger($ledger);
        $account->setPortfolio($portfolio);
        if ($priviledge) {
            $account->setPriviledge($priviledge);
        }

        $this->repository->add($account);

        return $account;
    }
}
