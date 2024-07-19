<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TaskRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;

class TaskController extends Controller
{
    protected $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository) {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $version = $request->attributes->get('api_version');
        $tasks = $this->taskRepository->all();
        
        return response()->json([
            'message' => 'List of all tasks',
            'tasks' => $tasks
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request)
    {
        $task = $this->taskRepository->create($request->validated());
        return response()->json([
            'message' => 'Task created successfully',
            'task' => $task
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = $this->taskRepository->find($id);
        if(!$task) {
            return response()->json([
                'message' => 'Task not found',
            ], 404);
        }

        if ($task && $task->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json([
            'message' => 'Task retrieved successfully',
            'task' => $task
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskUpdateRequest $request, string $id)
    {
        $task = $this->taskRepository->find($id);
        if(!$task) {
            return response()->json([
                'message' => 'Task not found',
            ], 404);
        }

        if ($task && $task->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $task = $this->taskRepository->update($request->validated(), $task);

        return response()->json([
            'message' => 'Task updated successfully',
            'task' => $task
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = $this->taskRepository->find($id);
        if(!$task) {
            return response()->json([
                'message' => 'Task not found',
            ], 404);
        }

        if ($task && $task->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $this->taskRepository->delete($task);
        return response()->json([
            'message' => 'Task delete successfully!',
            'task' => $task
        ], 200);
    }
}
