<?php

namespace App\Core\Domain\Model\Account;

use LogicException;

class Priviledge
{
    const OWNER = 'owner';
    const MANAGER = 'manager';
    const GROUP_EDIT = 'group-edit';
    const SOLO_EDIT = 'solo-edit';

    private static $allowedTypes = [
        self::OWNER,
        self::MANAGER,
        self::GROUP_EDIT,
        self::SOLO_EDIT,
    ];

    /**
     * @var string
     */
    private $type;

    public function __construct(string $type)
    {
        if (!in_array($type, self::$allowedTypes)) {
            throw new LogicException(
                "Not a valid account priviledge type: $type"
            );
        }
        $this->type = $type;
    }

    /**
     * Get the value of type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
