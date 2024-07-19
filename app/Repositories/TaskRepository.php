<?php

namespace App\Repositories;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskRepository implements TaskRepositoryInterface
{

    public function all()
    {
        return Task::where('user_id', Auth::user()->id)->get();
    }

    public function find($id)
    {
        return Task::find($id);
    }

    public function create(array $data)
    {
        $data['user_id'] = Auth::user()->id;
        return Task::create($data);
    }

    public function update(array $data, Task $task)
    {
        $task->update($data);
        return $task;
    }

    public function delete(Task $task)
    {
        return $task->delete();
    }

    public function paginateTasks(){
        return Task::where('user_id', Auth::user()->id)->paginate(10);
    }
}
