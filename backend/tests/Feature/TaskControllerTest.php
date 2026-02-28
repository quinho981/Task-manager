<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_tasks_by_project(): void
    {
        $project = Project::factory()->create();
        $tasks = Task::factory()->count(3)->create(['project_id' => $project->id]);

        $response = $this->getJson("/api/projects/{$project->id}/tasks");

        $response->assertStatus(200)
                ->assertJsonCount(3, 'data');
    }

    public function test_it_returns_tasks_by_project_with_filters(): void
    {
        $project = Project::factory()->create();
        Task::factory()->count(2)->create(['project_id' => $project->id, 'status' => 'todo']);
        Task::factory()->count(1)->create(['project_id' => $project->id, 'status' => 'in_progress']);

        $response = $this->getJson("/api/projects/{$project->id}/tasks?status=todo");

        $response->assertStatus(200)
                ->assertJsonCount(2, 'data');
    }

    public function test_it_creates_a_task(): void
    {
        $project = Project::factory()->create();

        $payload = [
            'title' => 'New Task',
            'description' => 'Task description',
            'status' => 'todo',
            'priority' => 'high',
            'due_date' => now()->addDays(7)->toDateString(),
        ];

        $response = $this->postJson("/api/projects/{$project->id}/tasks", $payload);

        $response->assertStatus(201)
                ->assertJsonFragment([
                    'title' => 'New Task'
                ]);

        $this->assertDatabaseHas('tasks', [
            'title' => 'New Task',
            'project_id' => $project->id
        ]);
    }

    public function test_it_updates_a_task(): void
    {
        $project = Project::factory()->create();
        $task = Task::factory()->create(['project_id' => $project->id]);

        $payload = [
            'status' => 'in_progress',
            'priority' => 'medium',
        ];

        $response = $this->patchJson("/api/tasks/{$task->id}", $payload);

        $response->assertStatus(200)
                ->assertJsonFragment([
                    'status' => 'in_progress',
                    'priority' => 'medium'
                ]);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'status' => 'in_progress',
            'priority' => 'medium'
        ]);
    }

    public function test_it_deletes_a_task(): void
    {
        $project = Project::factory()->create();
        $task = Task::factory()->create(['project_id' => $project->id]);

        $response = $this->deleteJson("/api/tasks/{$task->id}");

        $response->assertStatus(200)
                ->assertJsonFragment([
                    'message' => 'Task deleted successfully'
                ]);

        $this->assertSoftDeleted('tasks', [
            'id' => $task->id
        ]);
    }
}
