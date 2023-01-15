<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() && Auth::user()->can('manage-user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->getMethod() == 'POST') {
            return [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'role' => 'required|exists:roles,id',
                'password' => ['required', 'confirmed', Password::min(8)->numbers()->mixedCase()]
            ];
        } elseif($this->getMethod() == 'PUT') {
            return [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $this->user->id,
                'role' => 'required|exists:roles,id',
                'password' => ['required', 'confirmed', Password::min(8)->numbers()->mixedCase()]
            ];
        }
    }
}
