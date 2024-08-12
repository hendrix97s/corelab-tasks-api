<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

$methods = ["index", "store", "update", "destroy", "show"];

Route::get("/is-logged", function (Request $request) {
  return $request->user();
});

Route::group(["prefix" => "workspace/{workspace}"], function () use ($methods) {
  Route::resource('project', ProjectController::class)->only($methods);
  Route::resource('project.task-list', TaskListController::class)->only($methods);
  Route::resource('project.task-list.task', TaskController::class)->only($methods);
  Route::resource('task.comment', CommentController::class)->only(['index', 'store']);
});
