<?php

namespace App\Core\Domain\Model\User;

use App\Core\Domain\Model\Portfolio\Portfolio;
use App\Core\Domain\Model\Shared\AbstractDomainEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;

class User extends AbstractDomainEntity implements UserInterface
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var array
     */
    private $roles = [];

    /**
     * @var string
     */
    private $password;

    /**
     * @var bool
     */
    private $active;

    /**
     * @var Collection
     */
    private $portfolios;

    public function __construct()
    {
        $this->portfolios = new ArrayCollection();
    }

    /**
     * Add a Portfolio to this User.
     *
     * @param Portfolio $portfolio
     *
     * @return self
     */
    public function addPortfolio(Portfolio $portfolio): self
    {
        if (!$this->portfolios->contains($portfolio)) {
            $this->portfolios->add($portfolio);
            $portfolio->addUser($this);
        }

        return $this;
    }

    /**
     * Remove a Portfolio from this User.
     *
     * @param Portfolio $portfolio
     *
     * @return self
     */
    public function removePortfolio(Portfolio $portfolio): self
    {
        if ($this->portfolios->contains($portfolio)) {
            $this->portfolios->removeElement($portfolio);
            $portfolio->removeUser($this);
        }

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
     * Get the value of email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email.
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of firstname.
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname.
     *
     * @param string $firstname
     *
     * @return self
     */
    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname.
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname.
     *
     * @param string $lastname
     *
     * @return self
     */
    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Set the value of roles.
     *
     * @param array $roles
     *
     * @return self
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get the value of password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password.
     *
     * @param string $password
     *
     * @return self
     */
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return $this->email;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function getRoles()
    {
        $roles = $this->roles;

        // guarentee ever user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * Get the value of portfolios.
     *
     * @return Collection
     */
    public function getPortfolios()
    {
        return $this->portfolios;
    }
}
