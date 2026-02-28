<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class TaskService
{
    public function listByProject(int $id, array $filters = []): LengthAwarePaginator
    {
        $query = Task::where('project_id', $id);

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['priority'])) {
            $query->where('priority', $filters['priority']);
        }

        if (!empty($filters['due_date'])) {
            $query->overdue();
        }

        return $query->latest()->paginate(10);
    }

    public function create(array $data): Task
    {
        return Task::create($data);
    }

    public function update($id, array $data): Task
    {
        $task = Task::findOrFail($id);
        $task->update($data);
        
        return $task;
    }

    public function delete(int $id): void
    {
        $task = Task::findOrFail($id);
        $task->delete();
    }
}