<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskListRequest;
use App\Http\Requests\UpdateTaskListRequest;
use App\Models\TaskList;
use App\Repositories\TaskListRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskListController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request, TaskListRepository $repository)
  {
    $lists = $repository->getByWorkspaceAndProject($request->workspace, $request->project);
    return response()->json($lists);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreTaskListRequest $request, TaskListRepository $repository)
  {
    $data = $request->validated();
    $data['workspace_id'] = $request->workspace;
    $data['project_id'] = $request->project;

    $list = $repository->create($data);
    return response()->json($list);
  }

  /**
   * Display the specified resource.
   */
  public function show(Request $request,  TaskListRepository $repository)
  {
    $taskList = $repository->findByWorkspaceAndProject($request->workspace, $request->project, $request->task_list);
    return response()->json($taskList);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateTaskListRequest $request, TaskListRepository $repository)
  {
    $data = $request->validated();
    $taskList = $repository->updateByWorkspaceAndProject($request->workspace, $request->project, $data);
    return response()->json($taskList);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request, TaskListRepository $repository)
  {
    $deleted = $repository->deleteByWorkspaceAndProject($request->workspace, $request->project, $request->task_list);
    return response()->json($deleted);
  }
}
