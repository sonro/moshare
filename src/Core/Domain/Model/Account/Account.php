<?php

namespace App\Core\Domain\Model\Account;

use App\Core\Domain\Model\Shared\AbstractDomainEntity;

class Account extends AbstractDomainEntity
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Portfolio|null
     */
    private $portfolio;

    /**
     * @var Ledger|null
     */
    private $ledger;

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
     * Get the value of portfolio.
     *
     * @return Portfolio|null
     */
    public function getPortfolio()
    {
        return $this->portfolio;
    }

    /**
     * Set the value of portfolio.
     *
     * @param Portfolio|null $portfolio
     *
     * @return self
     */
    public function setPortfolio(?Portfolio $portfolio)
    {
        $this->portfolio = $portfolio;

        return $this;
    }

    /**
     * Get the value of ledger.
     *
     * @return Ledger|null
     */
    public function getLedger()
    {
        return $this->ledger;
    }

    /**
     * Set the value of ledger.
     *
     * @param Ledger|null $ledger
     *
     * @return self
     */
    public function setLedger(?Ledger $ledger)
    {
        $this->ledger = $ledger;

        return $this;
    }
}
