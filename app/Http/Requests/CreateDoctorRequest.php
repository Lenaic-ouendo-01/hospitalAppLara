<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password as RulesPassword;

class CreateDoctorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->role->code === Role::DIRECTOR;
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
            "password" => ['required', RulesPassword::min(8)],
            "email" => ['required', 'email'],
            "number" => ['required', 'starts_with:+229'],
            "nationality" => ['required', 'string'],
            "sex" => ['required', 'string'],
            "birth" => ['required', 'date'],
            "language" => ['required'],
            
        ];
    }
}
