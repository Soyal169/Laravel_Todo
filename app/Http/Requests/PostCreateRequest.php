<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest
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
            'image' => ['required', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:4000'],
            'body' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title is mandatory.',
            'image.required' => 'Please upload an image.',
            'image.mimes' => 'The image must be of type jpeg, png, jpg, gif, or svg.',
            'image.max' => 'The image size must not exceed 2MB.',
            'body.required' => 'The body content is required.',
        ];
    }

}
