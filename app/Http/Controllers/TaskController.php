<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Repositories\TaskRepository;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request, TaskRepository $repository)
  {
    $tasks = $repository->getTasksByWorkspaceAndProjectAndTaskList($request->workspace, $request->project, $request->task_list);
    return response()->json($tasks);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreTaskRequest $request, TaskService $service)
  {
    $data = $request->validated();
    $task = $service->create($request->workspace, $request->project, $request->task_list, $data);
    return response()->json($task);
  }

  /**
   * Display the specified resource.
   */
  public function show(Task $task)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Task $task)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateTaskRequest $request, TaskRepository $repository)
  {
    $data = $request->validated();
    $task = $repository->updateTaskByWorkspaceProjectAndTaskList($request->workspace, $request->project, $request->task_list, $request->task, $data);
    return response()->json($task);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Task $task)
  {
    //
  }
}
