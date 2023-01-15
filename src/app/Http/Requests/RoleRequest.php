<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() && Auth::user()->can('manage-permission');
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
                'name' => 'required|string|max:255|unique:roles,name',
                'permission' => 'required|array',
                'permission.*' => 'numeric|exists:permissions,id'
            ];
        } elseif ($this->getMethod() == 'PUT') {
            return [
                'name' => 'required|string|max:255|unique:roles,name,' . $this->role->id,
                'permission' => 'required|array',
                'permission.*' => 'numeric|exists:permissions,id'
            ];
        }
    }
}
