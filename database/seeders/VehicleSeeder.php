<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = [
            ['type' => 'car', 'brand' => 'Honda', 'model' => 'Civic', 'year' => 2024, 'price' => 89900.00, 'color' => 'Branco', 'mileage' => 0],
            ['type' => 'car', 'brand' => 'Honda', 'model' => 'Accord', 'year' => 2023, 'price' => 149900.00, 'color' => 'Preto', 'mileage' => 15000],
            ['type' => 'car', 'brand' => 'Honda', 'model' => 'City', 'year' => 2024, 'price' => 79900.00, 'color' => 'Prata', 'mileage' => 0],
            ['type' => 'car', 'brand' => 'Honda', 'model' => 'HR-V', 'year' => 2024, 'price' => 115900.00, 'color' => 'Cinza', 'mileage' => 0],
            ['type' => 'car', 'brand' => 'Honda', 'model' => 'CR-V', 'year' => 2023, 'price' => 159900.00, 'color' => 'Azul', 'mileage' => 20000],
            ['type' => 'car', 'brand' => 'Honda', 'model' => 'Fit', 'year' => 2024, 'price' => 75900.00, 'color' => 'Vermelho', 'mileage' => 0],
            ['type' => 'car', 'brand' => 'Honda', 'model' => 'Pilot', 'year' => 2022, 'price' => 189900.00, 'color' => 'Preto', 'mileage' => 35000],
            ['type' => 'car', 'brand' => 'Honda', 'model' => 'Odyssey', 'year' => 2023, 'price' => 229900.00, 'color' => 'Branco', 'mileage' => 25000],
            ['type' => 'car', 'brand' => 'Honda', 'model' => 'Civic', 'year' => 2023, 'price' => 84900.00, 'color' => 'Cinza', 'mileage' => 10000],
            ['type' => 'car', 'brand' => 'Honda', 'model' => 'Accord', 'year' => 2024, 'price' => 159900.00, 'color' => 'Prata', 'mileage' => 0],
            ['type' => 'motorcycle', 'brand' => 'Honda', 'model' => 'CBR 600RR', 'year' => 2024, 'price' => 54990.00, 'color' => 'Vermelho', 'mileage' => 0],
            ['type' => 'motorcycle', 'brand' => 'Honda', 'model' => 'CBR 1000RR', 'year' => 2024, 'price' => 99990.00, 'color' => 'Preto', 'mileage' => 0],
            ['type' => 'motorcycle', 'brand' => 'Honda', 'model' => 'PCX 160', 'year' => 2024, 'price' => 15990.00, 'color' => 'Branco', 'mileage' => 0],
            ['type' => 'motorcycle', 'brand' => 'Honda', 'model' => 'Biz 125', 'year' => 2024, 'price' => 10990.00, 'color' => 'Preto', 'mileage' => 0],
            ['type' => 'motorcycle', 'brand' => 'Honda', 'model' => 'Titan', 'year' => 2024, 'price' => 12990.00, 'color' => 'Vermelho', 'mileage' => 0],
            ['type' => 'motorcycle', 'brand' => 'Honda', 'model' => 'CB 500X', 'year' => 2023, 'price' => 35990.00, 'color' => 'Cinza', 'mileage' => 5000],
            ['type' => 'motorcycle', 'brand' => 'Honda', 'model' => 'Africa Twin', 'year' => 2023, 'price' => 49990.00, 'color' => 'Branco', 'mileage' => 8000],
            ['type' => 'motorcycle', 'brand' => 'Honda', 'model' => 'CBR 650R', 'year' => 2024, 'price' => 42990.00, 'color' => 'Vermelho', 'mileage' => 0],
            ['type' => 'motorcycle', 'brand' => 'Honda', 'model' => 'CB 300F', 'year' => 2024, 'price' => 18990.00, 'color' => 'Preto', 'mileage' => 0],
            ['type' => 'motorcycle', 'brand' => 'Honda', 'model' => 'Pop 110i', 'year' => 2024, 'price' => 6990.00, 'color' => 'Vermelho', 'mileage' => 0],
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::create($vehicle);
        }
    }
}