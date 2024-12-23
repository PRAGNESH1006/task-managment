<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreUserRequest extends FormRequest
{
  
    public function authorize(): bool
    {
        return Auth::check() && Auth::user();
    }

 
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',  
            'email' => 'required|email|unique:users,email',  
            'password' => 'required|string|min:8', 
            'role' => 'required|in:admin,employee,client', 
        ];
    }

    public function getInsertableFields(): array
    {
        return [
            'name' => $this->input('name'),
            'email' => $this->input('email'),
            'password' => bcrypt($this->input('password')),
            'role' => $this->input('role'),
            'created_by' => Auth::user()->id,
            'updated_by' => null,
        ];
    }
}
