<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHospitalRequest extends FormRequest
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
            "email" => ['required', 'email'],
            "number_fix" => ['required', 'starts_with:+229'],
            "number_mobile" => ['required', 'starts_with:+229'],
            "number_urgence" => ['required', 'starts_with:+229'],
            "city" => ['required', 'string'],
            "address" => ['required', 'string', 'max:250'],
            "description" => ['required', 'max:200'],
            "language" => ['required'],
        ];
    }
}
