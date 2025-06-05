<?php

namespace Database\Factories;

use App\Models\CaseFile;
use App\Models\Client;
use App\Models\Lawyer;
use App\Models\Court;
use Illuminate\Database\Eloquent\Factories\Factory;

class CaseFileFactory extends Factory
{
    protected $model = CaseFile::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'client_id' => Client::factory(),
            'lawyer_id' => Lawyer::factory(),
            'court_id' => Court::factory(),
        ];
    }
}
