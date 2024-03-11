<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuCategoryUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            // 'uuid' => ['required', 'string'],
            // 'owner_id' => ['required', 'integer'],
            'position' => ['nullable', 'integer'],
            'title' => ['required', 'string'],
            'status' => ['nullable', 'string'],
            'node_id' => ['nullable', 'integer'],
        ];
    }
}
