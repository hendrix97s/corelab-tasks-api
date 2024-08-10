<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $user = User::factory()->create([
      'name'     => 'Luiz F. Lima',
      'email'    => 'lf.system@outlook.com',
      'password' => Hash::make('senha123'),
    ]);

    // $userWorkspace = Workspace::factory()->create(['name' => 'Workspace']);
    // $user->workspaces()->attach($userWorkspace->id);
  }
}
