<?php

namespace Kuber\Http\Requests\Admin;

use Kuber\Rules\FileMaxMb;
use Illuminate\Foundation\Http\FormRequest;

class LogoAndFaviconRequest extends FormRequest
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
            'logo' => ['image', 'nullable', 'mimes:png,jpg,jpeg,webp', new FileMaxMb(2)],
            'favicon' => ['image', 'nullable', 'mimes:png,jpg,jpeg,webp', new FileMaxMb(2)],
        ];
    }
}
