<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateTaskRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return Auth::check();
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'name'        => 'sometimes|string|max:255',
      'description' => 'sometimes|string|nullable',
      'status_id'   => 'sometimes|numeric|exists:statuses,id',
      'expires_at'  => 'sometimes|date|nullable',
      'priority'    => 'sometimes|numeric|nullable',
      'assignee_id' => 'sometimes|numeric|exists:users,id',
    ];
  }
}
