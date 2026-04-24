<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_user_can_list_vehicles(): void
    {
        Vehicle::factory()->count(5)->create();

        $response = $this->getJson('/api/vehicles');

        $response->assertStatus(200);
    }

    public function test_unauthenticated_user_can_filter_vehicles_by_type(): void
    {
        Vehicle::factory()->count(3)->create(['type' => 'car']);
        Vehicle::factory()->count(2)->create(['type' => 'motorcycle']);

        $response = $this->getJson('/api/vehicles?type=car');

        $response->assertStatus(200);
    }

    public function test_unauthenticated_user_can_filter_vehicles_by_max_price(): void
    {
        Vehicle::factory()->create(['price' => 10000]);
        Vehicle::factory()->create(['price' => 50000]);
        Vehicle::factory()->create(['price' => 100000]);

        $response = $this->getJson('/api/vehicles?max_price=50000');

        $response->assertStatus(200);
    }

    public function test_authenticated_user_can_create_vehicle(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->postJson('/api/vehicles', [
                'type' => 'car',
                'model' => 'Civic',
                'year' => 2024,
                'price' => 89900,
                'color' => 'Branco',
                'mileage' => 0,
            ]);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'type' => 'car',
                'model' => 'Civic',
            ]);
    }

    public function test_unauthenticated_user_cannot_create_vehicle(): void
    {
        $response = $this->postJson('/api/vehicles', [
            'type' => 'car',
            'model' => 'Civic',
            'year' => 2024,
            'price' => 89900,
        ]);

        $response->assertStatus(401);
    }

    public function test_vehicle_validation_fails_with_invalid_data(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->postJson('/api/vehicles', [
                'type' => 'invalid',
                'year' => 1999,
                'price' => -100,
            ]);

        $response->assertStatus(422);
    }
}