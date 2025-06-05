<?php

namespace Database\Factories;

use App\Models\Hearing;
use App\Models\CaseFile;
use Illuminate\Database\Eloquent\Factories\Factory;

class HearingFactory extends Factory
{
    protected $model = Hearing::class;

    public function definition(): array
    {
        return [
            'case_id' => CaseFile::factory(),
            'scheduled_at' => $this->faker->dateTimeBetween('+1 days', '+1 month'),
            'notes' => $this->faker->sentence(),
        ];
    }
}
