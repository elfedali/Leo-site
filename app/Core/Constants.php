<?php

namespace App\Core;

class Constants
{
    public const USER_STATUS_ACTIVE = 'active';
    public const USER_STATUS_INACTIVE = 'inactive';
    public const USER_STATUS_BLOCKED = 'blocked';
    public const USER_STATUSES = [
        self::USER_STATUS_ACTIVE,
        self::USER_STATUS_INACTIVE,
        self::USER_STATUS_BLOCKED,
    ];
}
