<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function indexByProject(Request $request, int $projectId)
    {
        $tasks = $this->taskService->listByProject($projectId, $request->only(['status', 'priority', 'due_date']));

        return TaskResource::collection($tasks);
    }

    public function store(StoreTaskRequest $request, int $projectId)
    {
        $data = $request->validated();

        $task = $this->taskService->create(array_merge($data, ['project_id' => $projectId]));
        return new TaskResource($task);
    }

    public function update(UpdateTaskRequest $request, int $id)
    {
        $data = $request->validated();

        $task = $this->taskService->update($id, $data);
        return new TaskResource($task);
    }

    public function destroy(int $id)
    {
        $this->taskService->delete($id);
        return response()->json(['message' => 'Task deleted successfully']);
    }
}
