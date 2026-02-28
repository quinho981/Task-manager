<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectsRequest;
use App\Http\Resources\ProjectResource;
use App\Services\ProjectService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProjectController extends Controller
{
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function index(): AnonymousResourceCollection
    {
        $projects = $this->projectService->getAll();

        return ProjectResource::collection($projects);
    }

    public function store(StoreProjectsRequest $request): ProjectResource
    {
        $data = $request->validated();

        $projects = $this->projectService->create($data);
        return new ProjectResource($projects);
    }
}
