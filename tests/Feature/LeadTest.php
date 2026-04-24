<?php

namespace Tests\Feature;

use App\Models\Lead;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeadTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_user_can_create_lead(): void
    {
        $vehicle = Vehicle::factory()->create();

        $response = $this->postJson('/api/leads', [
            'name' => 'João Silva',
            'email' => 'joao@example.com',
            'phone' => '(11) 99999-9999',
            'vehicle_id' => $vehicle->id,
            'message' => 'Tenho interesse',
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'name' => 'João Silva',
                'email' => 'joao@example.com',
            ]);
    }

    public function test_lead_validation_fails_with_invalid_data(): void
    {
        $response = $this->postJson('/api/leads', [
            'name' => '',
            'email' => 'invalid-email',
            'phone' => '',
            'vehicle_id' => 999,
        ]);

        $response->assertStatus(422);
    }

    public function test_authenticated_user_can_list_leads(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test-token')->plainTextToken;

        $vehicle = Vehicle::factory()->create();
        Lead::factory()->count(3)->create(['vehicle_id' => $vehicle->id]);

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->getJson('/api/leads');

        $response->assertStatus(200);
    }

    public function test_unauthenticated_user_cannot_list_leads(): void
    {
        $response = $this->getJson('/api/leads');

        $response->assertStatus(401);
    }
}