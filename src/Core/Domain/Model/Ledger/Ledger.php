<?php

namespace App\Core\Domain\Model\Ledger;

use App\Core\Domain\Model\Shared\AbstractDomainEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Ledger extends AbstractDomainEntity
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Collection
     */
    private $accounts;

    public function __construct()
    {
        $this->accounts = new ArrayCollection();
    }

    /**
     * Get the value of name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name.
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of accounts.
     *
     * @return Collection
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * Add an account to this ledger.
     *
     * @param Account $account
     *
     * @return self
     */
    public function addAccount(Account $account)
    {
        if (!$this->accounts->contains($account)) {
            $this->accounts->add($account);
            $account->setLedger($this);
        }

        return $this;
    }

    /**
     * Add an account to this ledger.
     *
     * @param Account $account
     *
     * @return self
     */
    public function removeAccount(Account $account)
    {
        if ($this->accounts->contains($account)) {
            $this->accounts->removeElement($account);
            $account->setLedger(null);
        }

        return $this;
    }
}
