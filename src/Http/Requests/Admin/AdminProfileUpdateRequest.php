<?php

namespace Kuber\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class AdminProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', Rule::unique('admins')->ignore(Auth::guard('admin')->id()), 'min:4', 'max:255'],
            'desc' => ['nullable', 'max:255'],
            'image' => ['image', 'nullable', 'mimes:png,jpg,jpeg', 'max:2048'],
        ];
    }
}
