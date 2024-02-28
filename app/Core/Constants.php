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

    public const USER_ROLE_USER = 'user';
    public const USER_ROLE_ADMIN = 'admin';
    public const USER_COMMERCIAL = 'commercial';
    public const USER_ROLES = [
        self::USER_ROLE_USER,
        self::USER_ROLE_ADMIN,
        self::USER_COMMERCIAL,
    ];

    public const NODE_STATUS_DRAFT = 'draft';
    public const NODE_STATUS_PUBLISHED = 'published';
    public const NODE_STATUSES = [
        self::NODE_STATUS_DRAFT,
        self::NODE_STATUS_PUBLISHED,
    ];

    public const NODE_TYPE_RESTAURANT = 'restaurant';
    public const NODE_TYPE_HOTEL = 'hotel';
    public const NODE_TYPE = [
        self::NODE_TYPE_RESTAURANT,
        self::NODE_TYPE_HOTEL,
    ];

    public const REVIEW_STATUS_DRAFT = 'draft';
    public const REVIEW_STATUS_PUBLISHED = 'published';
    public const REVIEW_STATUSES = [
        self::REVIEW_STATUS_DRAFT,
        self::REVIEW_STATUS_PUBLISHED,
    ];

    public const REVIEW_APPROVED = 'approved';
    public const REVIEW_NOT_APPROVED = 'not_approved';
    public const REVIEW_APPROVAL_STATUSES = [
        self::REVIEW_APPROVED,
        self::REVIEW_NOT_APPROVED,
    ];
}
