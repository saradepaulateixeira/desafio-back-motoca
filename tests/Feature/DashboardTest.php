<?php

namespace Tests\Feature;

use App\Models\Lead;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_access_dashboard(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test-token')->plainTextToken;

        Vehicle::factory()->count(5)->create();
        Lead::factory()->count(10)->create();

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->getJson('/api/dashboard');

        $response->assertStatus(200);
    }

    public function test_unauthenticated_user_cannot_access_dashboard(): void
    {
        $response = $this->getJson('/api/dashboard');

        $response->assertStatus(401);
    }

    public function test_dashboard_returns_totals(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test-token')->plainTextToken;

        Vehicle::factory()->count(3)->create();
        Lead::factory()->count(5)->create();

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->getJson('/api/dashboard');

        $response->assertStatus(200);
    }
}