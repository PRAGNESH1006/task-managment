<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && Auth::user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->route('user')), 
            ],
            'role' => 'required|in:admin,employee,client',
        ];
    }

    /**
     * Get the fields that should be updated in the database.
     *
     * @return array
     */
    public function getUpdateableFields(): array
    {
        return [
            'name' => $this->input('name'),
            'email' => $this->input('email'),
            'role' => $this->input('role'),
            'updated_by' => Auth::user()->id,
        ];

        
    }
}
