<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskCreateRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'desc' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:4000'],
            'is_completed' => ['boolean'],
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'The title is mandatory.',
            'desc.max' => 'The description must not exceed 255 characters.',
            'is_completed.boolean' => 'The is completed field must be a boolean value.',
            'desc.required' => 'The description is required.',
        ];
    }
}
