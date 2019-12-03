<?php

namespace App\Core\Domain\Model\Transaction;

use App\Core\Domain\Model\Account\Account;
use App\Core\Domain\Model\Ledger\Ledger;
use App\Core\Domain\Model\Shared\AbstractTimestampableDomainEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Transaction extends AbstractTimestampableDomainEntity
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var Transactor
     */
    private $from;

    /**
     * @var Transactor
     */
    private $to;

    /**
     * @var int
     */
    private $value;

    /**
     * @var Ledger
     */
    private $ledger;

    /**
     * @var bool
     */
    private $splitEvenly;

    /**
     * @var Collection
     */
    private $liableAccounts;

    public function __construct()
    {
        $this->splitEvenly = true;
        $this->liableAccounts = new ArrayCollection();
    }

    /**
     * Get the value of title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title.
     *
     * @param string $title
     *
     * @return self
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description.
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of value.
     *
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value of value.
     *
     * @param int $value
     *
     * @return self
     */
    public function setValue(int $value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get the value of ledger.
     *
     * @return Ledger
     */
    public function getLedger()
    {
        return $this->ledger;
    }

    /**
     * Set the value of ledger.
     *
     * @param Ledger $ledger
     *
     * @return self
     */
    public function setLedger(Ledger $ledger)
    {
        $this->ledger = $ledger;

        return $this;
    }

    /**
     * Are all ledger members liable for this transaction.
     *
     * Returns true if no accounts have been defined to be
     * directly liable for this transaction.
     *
     * @return bool
     */
    public function isSplitEvenly()
    {
        return $this->splitEvenly;
    }

    /**
     * Get the value of liableAccounts.
     *
     * @return Collection
     */
    public function getLiableAccounts()
    {
        return $this->liableAccounts;
    }

    /**
     * Add an Account that is liable for this transaction.
     *
     * @param Account $account
     *
     * @return self
     */
    public function addLiableAccount(Account $account): self
    {
        if (!$this->liableAccounts->contains($account)) {
            $this->liableAccounts->add($account);
            $this->splitEvenly = false;
        }

        return $this;
    }

    /**
     * Remove an Account that is liable for this transaction.
     *
     * @param Account $account
     *
     * @return self
     */
    public function removeLiableAccount(Account $account): self
    {
        if ($this->liableAccounts->contains($account)) {
            $this->liableAccounts->removeElement($account);
            if ($this->liableAccounts->isEmpty()) {
                $this->splitEvenly = true;
            }
        }

        return $this;
    }

    /**
     * Get the value of from.
     *
     * @return Transactor
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set the value of from.
     *
     * @param Transactor $from
     *
     * @return self
     */
    public function setFrom(Transactor $from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get the value of to.
     *
     * @return Transactor
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Set the value of to.
     *
     * @param Transactor $to
     *
     * @return self
     */
    public function setTo(Transactor $to)
    {
        $this->to = $to;

        return $this;
    }
}
