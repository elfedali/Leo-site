<?php

namespace App\JsonApi\V1\Users;

use Illuminate\Validation\Rule;
use LaravelJsonApi\Core\Document\JsonApi;
use LaravelJsonApi\Laravel\Http\Requests\ResourceRequest;
use LaravelJsonApi\Validation\Rule as JsonApiRule;

class UserRequest extends ResourceRequest
{

    /**
     * Get the validation rules for the resource.
     *
     * @return array
     */
    public function rules(): array
    {
        $data = $this->validationData();
        dd($data);

        return [

            'username' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'email', 'max:255'],
            // 'password' => ['required', 'string', 'min:8'],
            // 'bio' => ['string', 'max:255'],

        ];
    }
}
