<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_all_projects(): void
    {
        Project::factory()->count(3)->create();

        $response = $this->getJson('/api/projects');

        $response->assertStatus(200)
                ->assertJsonCount(3, 'data');
    }

    public function test_it_creates_a_project(): void
    {
        $payload = [
            'name' => 'New Project',
            'description' => 'Project description',
        ];

        $response = $this->postJson('/api/projects', $payload);

        $response->assertStatus(201)
                ->assertJsonFragment([
                    'name' => 'New Project'
                ]);

        $this->assertDatabaseHas('projects', [
            'name' => 'New Project'
        ]);
    }

    public function test_store_fails_without_name(): void
    {
        $response = $this->postJson('/api/projects', []);

        $response->assertStatus(422)
                ->assertJsonValidationErrors(['name']);
    }
}
