<?php
namespace App\Models;

class Role
{
    public const ADMIN = 'Admin';
    public const SENIOR_LAWYER = 'Senior Lawyer';
    public const JUNIOR_LAWYER = 'Junior Lawyer';
    public const LEGAL_ASSISTANT = 'Legal Assistant';
    public const CLIENT = 'Client';

    public static function all(): array
    {
        return [
            self::ADMIN,
            self::SENIOR_LAWYER,
            self::JUNIOR_LAWYER,
            self::LEGAL_ASSISTANT,
            self::CLIENT,
        ];
    }
}
