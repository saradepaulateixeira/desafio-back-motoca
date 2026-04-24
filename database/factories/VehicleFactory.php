<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    public function definition(): array
    {
        $types = ['car', 'motorcycle'];
        $type = $this->faker->randomElement($types);

        $carModels = ['Civic', 'Accord', 'City', 'HR-V', 'CR-V', 'Fit', 'Pilot', 'Odyssey'];
        $motorcycleModels = ['CBR 600RR', 'CBR 1000RR', 'PCX 160', 'Biz 125', 'Titan', 'CB 500X', 'Africa Twin'];

        $models = $type === 'car' ? $carModels : $motorcycleModels;

        return [
            'type' => $type,
            'brand' => 'Honda',
            'model' => $this->faker->randomElement($models),
            'year' => $this->faker->numberBetween(2000, 2025),
            'price' => $this->faker->randomFloat(2, 15000, 150000),
            'color' => $this->faker->safeColorName(),
            'mileage' => $this->faker->numberBetween(0, 100000),
        ];
    }
}