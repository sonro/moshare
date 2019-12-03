<?php

namespace App\Core\Application\Service;

use App\Core\Domain\Model\Ledger\Ledger;
use App\Core\Domain\Model\Transaction\Transaction;
use App\Core\Domain\Model\Transaction\Transactor;
use App\Core\Domain\Repository\TransactionRepositoryInterface;

final class TransactionService
{
    /**
     * @var TransactionRepositoryInterface
     */
    private $repository;

    public function __construct(TransactionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(
        string $title,
        string $description,
        Ledger $ledger,
        Transactor $from,
        Transactor $to,
        int $value,
        array $liableAccounts
    ): Transaction {
        $transaction = new Transaction();
        $transaction->setTitle($title);
        $transaction->setDescription($description);
        $transaction->setLedger($ledger);
        $transaction->setFrom($from);
        $transaction->setTo($to);
        $transaction->setValue($value);
        foreach ($liableAccounts as $account) {
            $transaction->addLiableAccount($account);
        }

        $this->repository->add($transaction);

        return $transaction;
    }
}
