<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Repositories\CommentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request, CommentRepository $repository)
  {
    $comments = $repository->getByTask($request->task);
    return response()->json($comments);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreCommentRequest $request, CommentRepository $repository)
  {
    $data            = $request->validated();
    $data['task_id'] = $request->task;
    $data['user_id'] = Auth::user()->id;
    $comment         = $repository->create($data);

    return response()->json($comment);
  }
}
