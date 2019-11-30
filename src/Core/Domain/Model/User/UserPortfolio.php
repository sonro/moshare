<?php

namespace App\Core\Domain\Model\User;

use App\Core\Domain\Model\Portfolio\Portfolio;
use App\Core\Domain\Model\Shared\AbstractDomainEntity;

class UserPortfolio extends AbstractDomainEntity
{
    /**
     * @var User|null
     */
    private $user;

    /**
     * @var Portfolio|null
     */
    private $portfolio;

    /**
     * Get the value of user.
     *
     * @return User|null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user.
     *
     * @param User $user
     *
     * @return self
     */
    public function setUser(?User $user)
    {
        $this->user = $user;

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
     * @param Portfolio $portfolio
     *
     * @return self
     */
    public function setPortfolio(?Portfolio $portfolio)
    {
        $this->portfolio = $portfolio;

        return $this;
    }
}
