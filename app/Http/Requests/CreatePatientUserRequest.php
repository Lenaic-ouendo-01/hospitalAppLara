<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class CreatePatientUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->role->code === Role::DIRECTOR || Auth::user()->role->code === Role::DOCTOR  ;
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
            "phoneNumber" => ['required', 'starts_with:+229'],
            "nation" => ['required', 'string'],
            "sex" => ['required', 'string'],
            "birth" => ['required', 'date'],
            "address" => ['required', 'string', 'max:250'],
            "profession" => ['required', 'max:200'],
            "allergies" => ['required', 'max:250'],
            "history_diseases" => ['nullable'],
            "ex_surgery" => ['string','nullable'],
            "vaccine" => ['nullable' ,'required'],
            "hereditary" => ['nullable','required'],
            "insurance" => [ 'nullable','required'],
            "emergency_contact" => ['nullable','required'],
            "blood_type" => ['required', 'string'],
            "language" => ['required'],
            "marital_status" => ['required'],
        ];
    }
}
