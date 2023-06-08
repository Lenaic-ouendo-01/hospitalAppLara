<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctorRequest extends FormRequest
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
        return   [
            "name" => ['required', 'string', 'max:200'],
            "number" => ['required', 'starts_with:+229'],
            "nation" => ['required', 'string'],
            "sex" => ['required', 'string'],
            "birth" => ['required', 'date'],
            "language" => ['required']
        ];
    }
}
