<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;

class ProjectService
{
    public function getAll()
    {
        return Project::query()->latest()->paginate(9);
    }

    public function create(array $data): Project
    {
        return Project::create($data);
    }
}