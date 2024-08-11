<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('tasks', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->text('description')->nullable();
      $table->foreignId('status_id')->nullable()->constrained('statuses');
      $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
      $table->foreignId('workspace_id')->constrained('workspaces')->onDelete('cascade');
      $table->dateTime('expires_at')->nullable();
      $table->integer('priority')->default(0);
      $table->foreignId('assignee_id')->nullable()->constrained('users');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('tasks');
  }
};
