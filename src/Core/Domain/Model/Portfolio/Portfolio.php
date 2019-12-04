<?php

namespace App\Core\Domain\Model\Portfolio;

use App\Core\Domain\Model\Account\Account;
use App\Core\Domain\Model\Shared\AbstractDomainEntity;
use App\Core\Domain\Model\User\User;
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
    private $users;

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
        $this->users = new ArrayCollection();
        $this->accounts = new ArrayCollection();
    }

    /**
     * Add a User to this Portfolio.
     *
     * @param User $user
     *
     * @return self
     */
    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addPortfolio($this);
        }

        return $this;
    }

    /**
     * Remove a User from this Portfolio.
     *
     * @param User $user
     *
     * @return self
     */
    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            $user->removePortfolio($this);
        }

        return $this;
    }

    /**
     * Get the User Collection.
     *
     * @return Collection
     */
    public function getUsers()
    {
        return $this->users;
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
