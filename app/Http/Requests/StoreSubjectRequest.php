<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectRequest extends FormRequest
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
            "name" => "required|string|max:255",
            "acedemic_year" => "year|required",
            'students' => 'array|exists:students,id',
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "El nombre de la materia es obligatorio.",
            "name.string" => "El nombre de la materia debe ser una cadena de texto.",
            "name.max" => "El nombre de la materia no debe exceder los 255 caracteres.",
            "acedemic_year.required" => "El año académico es obligatorio.",
            "acedemic_year.year" => "El año académico debe ser un año válido.",
        ];
    }
}
