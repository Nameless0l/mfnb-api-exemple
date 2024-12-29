<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'uuid' => 'nullable|uuid',
            'name' => 'string|max:255',
            'email' => 'string|max:255|unique:users,email',
            'email_verified_at' => 'nullable|date',
            'is_admin' => 'integer|min:0|max:1',
            'is_stylist' => 'integer|min:0|max:1',
            'password' => 'string|max:255',
            'updated_at' => 'required|date',
            'remember_token' => 'string|max:100',
        ];
    }
}
