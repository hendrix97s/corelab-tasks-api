<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request, ProjectRepository $repository)
  {
    $projects = $repository->getByWorkspace($request->workspace);
    return response()->json($projects);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreProjectRequest $request, ProjectService $service)
  {
    $project = $service->create($request->workspace, $request->validated());
    return response()->json($project);
  }

  /**
   * Display the specified resource.
   */
  public function show(Request $request, ProjectRepository $repository)
  {
    $project = $repository->findByWorkspace($request->workspace, $request->project);
    return response()->json($project);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateProjectRequest $request, Project $project)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Project $project)
  {
    //
  }
}
