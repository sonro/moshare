<?php

namespace App\Core\Domain\Model\Transaction;

use App\Core\Domain\Model\Account\Account;
use App\Core\Domain\Model\Shared\AbstractDomainEntity;

class Transactor extends AbstractDomainEntity
{
    /**
     * @var bool
     */
    private $external;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var Account|null
     */
    private $account;

    private function __construct(?string $name, ?Account $account = null)
    {
        if ($name) {
            $this->external = true;
            $this->name = $name;
            $this->account = null;
        } else {
            $this->external = false;
            $this->name = null;
            $this->account = $account;
        }
    }

    public static function createExternal(string $name): self
    {
        return new self($name, null);
    }

    public static function createInternal(Account $account): self
    {
        return new self(null, $account);
    }

    /**
     * Is the Transactor external to the Ledger.
     *
     * @return bool
     */
    public function isExternal()
    {
        return $this->external;
    }

    /**
     * Get the value of name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of account.
     *
     * @return Account|null
     */
    public function getAccount()
    {
        return $this->account;
    }
}
