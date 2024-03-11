<?php

namespace App\JsonApi\V1\MenuCategories;

use Illuminate\Validation\Rule;
use LaravelJsonApi\Laravel\Http\Requests\ResourceRequest;
use LaravelJsonApi\Validation\Rule as JsonApiRule;

class MenuCategoryRequest extends ResourceRequest
{

    /**
     * Get the validation rules for the resource.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            // 'status' => ['required', 'string', Rule::in(['published', 'draft'])],
            'node_id' => ['required', 'exists:nodes,id'],
            'owner_id' => ['required', 'exists:users,id'],
        ];
    }
}
