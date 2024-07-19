<?php

namespace App\Repositories;
use App\Models\Task;

interface TaskRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update(array $data, Task $task);
    public function delete(Task $id);
    public function paginateTasks();
}
