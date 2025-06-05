<?php
namespace Database\Seeders;

use App\Models\Role;

class RoleSeeder
{
    public static function seed(): array
    {
        return Role::all();
    }
}
