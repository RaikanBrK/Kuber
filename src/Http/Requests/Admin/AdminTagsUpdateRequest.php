<?php

namespace Kuber\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminTagsUpdateRequest extends FormRequest
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
            'head' => ['nullable', 'max:65500'],
            'body' => ['nullable', 'max:65500'],
        ];
    }
}
