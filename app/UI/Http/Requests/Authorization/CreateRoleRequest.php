<?php

namespace App\UI\Http\Requests\Authorization;

use Illuminate\Foundation\Http\FormRequest;

final class CreateRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'key' => [
                'required',
                'string',
                'alpha_dash',
                'min:3',
                'max:64',
                'unique:roles,key',
            ],
            'name' => [
                'required',
                'string',
                'min:3',
                'max:128',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'key.alpha_dash' => 'Role key may only contain letters, numbers, dashes and underscores.',
        ];
    }
}
