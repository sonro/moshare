<?php

namespace App\Core\Domain\Model\Portfolio;

use App\Core\Domain\Model\Account\Account;
use App\Core\Domain\Model\Shared\AbstractDomainEntity;
use App\Core\Domain\Model\User\UserPortfolio;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Portfolio extends AbstractDomainEntity
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Collection
     */
    private $userPortfolios;

    /**
     * @var bool
     */
    private $active;

    /**
     * @var Collection
     */
    private $accounts;

    public function __construct()
    {
        $this->userPortfolios = new ArrayCollection();
        $this->accounts = new ArrayCollection();
    }

    /**
     * Add a UserPortfolio to this Portfolio.
     *
     * @param UserPortfolio $userPortfolios
     *
     * @return self
     */
    public function addUserPortfolio(UserPortfolio $userPortfolio): self
    {
        if (!$this->userPortfolios->contains($userPortfolio)) {
            $this->userPortfolios->add($userPortfolio);
            $userPortfolio->addPortfolio($this);
        }

        return $this;
    }

    /**
     * Remove a UserPortfolio from this Portfolio.
     *
     * @param UserPortfolio $userPortfolio
     *
     * @return self
     */
    public function removeUserPortfolio(UserPortfolio $userPortfolio): self
    {
        if ($this->userPortfolios->contains($userPortfolio)) {
            $this->userPortfolios->removeElement($userPortfolio);
            $userPortfolio->setPortfolio(null);
        }

        return $this;
    }

    /**
     * Get the UserPortfolio Collection.
     *
     * @return Collection
     */
    public function getUserPortfolios()
    {
        return $this->userPortfolios;
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
     * Get the value of active.
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Set the value of active.
     *
     * @param bool $active
     *
     * @return self
     */
    public function setActive(bool $active)
    {
        $this->active = $active;

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
     * Add an Account to this Portfolio.
     *
     * @param Account $account
     *
     * @return self
     */
    public function addAccount(Account $account): self
    {
        if (!$this->accounts->contains($account)) {
            $this->accounts->add($account);
            $account->addPortfolio($this);
        }

        return $this;
    }

    /**
     * Removes an Account from this Portfolio.
     *
     * @param Account $account
     *
     * @return self
     */
    public function removeAccount(Account $account): self
    {
        if ($this->accounts->contains($account)) {
            $this->accounts->removeElement($account);
            $account->setPortfolio(null);
        }

        return $this;
    }
}
