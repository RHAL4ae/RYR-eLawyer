<?php
namespace App\Models;

class User
{
    public string $name;
    public string $email;
    public string $role;
    public array $devices = [];
    public array $auditLogs = [];

    public function __construct(string $name, string $email, string $role)
    {
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
    }
}
