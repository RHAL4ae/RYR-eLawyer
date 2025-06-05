<?php
namespace Database\Seeders;

class DatabaseSeeder
{
    public static function seed(): array
    {
        $roles = RoleSeeder::seed();
        $users = UserSeeder::seed();

        return ['roles' => $roles, 'users' => $users];
    }
}
