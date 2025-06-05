<?php

return [
    'tenant_model' => App\Models\Tenant::class,
    'central_connection' => env('DB_CONNECTION', 'pgsql'),
    'tenant_connection' => 'tenant',

    // Subdomain identification configuration
    'identification' => [
        'driver' => 'subdomain',
        // Base domain used to distinguish tenants
        'base_domain' => env('APP_DOMAIN', 'localhost'),
    ],

    'paths' => [
        'migrations' => database_path('tenant/migrations'),
    ],
];
