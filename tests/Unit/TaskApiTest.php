<?php

namespace Tests\Unit;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_create_task(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('token')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => "Bearer $token"])
            ->postJson('/api/tasks', [
                'title' => 'Test Task',
                'description' => 'Test Description',
                'due_date' => '2022-01-01',
                'status' => 'pending',
                'user_id' => $user->id,
            ]);
        $response->assertStatus(201)
            ->assertJson(['message' => 'Task created successfully']);
    }

    public function test_get_task(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('token')->plainTextToken;
        $task = Task::factory()->create(['user_id' => $user->id]);

        print_r($task->id);

        $response = $this->withHeaders(['Authorization' => "Bearer $token"])
            ->getJson('/api/tasks/'.$task->id);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Task retrieved successfully']);
    }
}
