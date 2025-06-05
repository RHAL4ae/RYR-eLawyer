<?php
require __DIR__ . '/autoload.php';

use Database\Seeders\DatabaseSeeder;

$result = DatabaseSeeder::seed();

file_put_contents(__DIR__ . '/storage/seed_output.json', json_encode($result, JSON_PRETTY_PRINT));

echo "Seeding complete.\n";
