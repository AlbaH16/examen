<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolicitudRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre_solicitante'=>['required','regex:/^[a-zA-Z ]*$/ '],
            'paterno_solicitante'=>['required','regex:/^[a-zA-Z ]*$/ '],
            'materno_solicitante'=>['required','regex:/^[a-zA-Z ]*$/ '],
        ];
    }
}
