<?php

namespace App\Core\Domain\Model\Shared;

use DateTime;

abstract class AbstractTimestampableDomainEntity extends AbstractDomainEntity
{
    /**
     * @var DateTime
     */
    protected $createdAt;

    /**
     * @var DateTime
     */
    protected $updatedAt;

    /**
     * Trigger on entity creation.
     */
    public function initCreatedAt()
    {
        if ($this->createdAt === null) {
            $this->createdAt = new DateTime();
            $this->updatedAt = $this->createdAt;
        }
    }

    /**
     * Trigger on entity update.
     */
    public function setUpdatedAtToNow()
    {
        $this->updatedAt = new DateTime();
    }

    /**
     * Get the value of createdAt.
     *
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * Get the value of updatedAt.
     *
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }
}
