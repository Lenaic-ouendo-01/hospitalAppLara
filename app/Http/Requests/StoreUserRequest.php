<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
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
            "email" => ['required', 'email', 'unique:users,email'],
            "phoneNumber" => ['required', 'string', 'starts_with:+229', 'max:200'],
            "sex" => ['required', 'string'],
            "nationality" => ['required', 'string'],
            'birth' => ['required', 'date'] ,
        ];
    }


    public function attributes()
    {
        return [
            'name' => 'nom complet',
            'mot de passe' => 'nom complet',
            'phoneNumber' => 'numéro de téléphone',
            'sex' => 'sexe',
            'nationality' => 'nationalité'
        ];
    }
}
