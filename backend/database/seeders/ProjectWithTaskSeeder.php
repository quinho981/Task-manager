<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectWithTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::factory()
            ->count(10)
            ->create()
            ->each(fn ($project) =>
                $project->tasks()->saveMany(
                    \App\Models\Task::factory()->count(rand(3, 8))->make()
                )
            );
    }
}
