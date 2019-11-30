<?php

namespace App\Core\Domain\Model\Shared;

abstract class AbstractDomainEntity
{
    /**
     * @var int
     */
    protected $id;

    /**
     * Get the value of id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
