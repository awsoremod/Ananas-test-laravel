<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|max:255|min:3|string',
            'email' => [
                'required',
                'email'
            ],
            'password' => [
                'bail',
                'required',
                'confirmed', // password_confirmation
                'min:3',
                'max:255',
                'string'
            ]
        ];
    }
}