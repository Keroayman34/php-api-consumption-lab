<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\ApiFormRequest;

class UpdatePostRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:3'],
            'content' => ['required', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
