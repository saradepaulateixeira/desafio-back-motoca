<?php

namespace Database\Factories;

use App\Models\Lead;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeadFactory extends Factory
{
    protected $model = Lead::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'vehicle_id' => Vehicle::query()->inRandomOrder()->value('id') ?? Vehicle::factory(),
            'message' => $this->faker->optional()->sentence(),
        ];
    }
}