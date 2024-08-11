<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

$methods = ["index", "store", "update", "destroy", "show"];

Route::get("/is-logged", function (Request $request) {
  return $request->user();
});

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
  return $request->user();
});

Route::group(["prefix" => "workspace/{workspace}"], function () use (
  $methods
) {
  Route::resource('project', ProjectController::class)->only($methods);
  Route::resource('project.tasks', TaskController::class)->only($methods);
});
