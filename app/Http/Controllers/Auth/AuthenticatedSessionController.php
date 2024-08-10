<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
  /**
   * Handle an incoming authentication request.
   */
  public function store(LoginRequest $request): JsonResponse
  {
    try {
      if (! Auth::attempt($request->only('email', 'password'), $request->remember ?? false)) {
        return response()->json([
          'message' => __('messages.Invalid credentials')
        ], 401);
      }

      $user = User::where('email', $request->email)->first();

      if (! $user->hasVerifiedEmail()) {
        return response()->json([
          'message' => __('messages.Email not verified')
        ], 401);
      }

      $user->token = $user->createToken('auth_token')->plainTextToken;
      Auth::login($user);
      return response()->json($user);
    } catch (\Throwable $th) {
      return response()->json([
        'message' => $th->getMessage(),
        'status'  => 'error',
        'data'    => []
      ], 500);
    }
  }

  /**
   * Destroy an authenticated session.
   */
  public function destroy(Request $request): Response
  {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return response()->noContent(200);
  }
}
