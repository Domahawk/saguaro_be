<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->user->id, 'id'),
            ],
            'username' => [
                'required',
                Rule::unique('users', 'username')->ignore($this->user->id, 'id'),
            ],
            'password' => 'min:8',
            'admin' => 'boolean',
        ];
    }
}
