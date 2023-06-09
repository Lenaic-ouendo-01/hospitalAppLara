<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterUserRequest extends FormRequest
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
            "name" => ['required', 'string', 'max:200'],
            "password" => ['required', Password::min(8)],
            "email" => ['required', 'email'],
        ];
    }


    public function attributes()
    {
        return [
            'name' => 'nom complet',
            'mot de passe' => 'nom complet',
        ];
    }
}
