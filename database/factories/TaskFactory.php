<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Status;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'name'         => fake()->name(),
      'description'  => fake()->sentence(),
      'status_id'    => Status::factory(),
      'project_id'   => Project::factory(),
      'workspace_id' => Workspace::factory(),
      'expires_at'   => fake()->dateTime(),
      'priority'     => fake()->randomElement(['low', 'medium', 'high']),
      'assignee_id'  => User::factory()
    ];
  }
}
