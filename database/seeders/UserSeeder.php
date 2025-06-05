<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;

class UserSeeder
{
    public static function seed(): array
    {
        return [
            new User('Alice Admin', 'alice@example.com', Role::ADMIN),
            new User('Sam Senior', 'sam@example.com', Role::SENIOR_LAWYER),
            new User('Jane Junior', 'jane@example.com', Role::JUNIOR_LAWYER),
            new User('Larry Assistant', 'larry@example.com', Role::LEGAL_ASSISTANT),
            new User('Cathy Client', 'cathy@example.com', Role::CLIENT),
        ];
    }
}
