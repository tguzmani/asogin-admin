<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email',
            'phone' => 'string|max:15',
            'date_of_birth' => 'date',
            'gender' => 'string|in:male,female,other',
            'address' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'El primer nombre es obligatorio.',
            'last_name.required' => 'El apellido es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'Este correo electrónico ya está registrado.',

            'phone.string' => 'El teléfono debe ser una cadena de texto.',
            'gender.required' => 'El género es obligatorio',
            'gender.string' => 'El género es obligatorio',
            'date_of_birth.required' => 'La fecha de nacimiento es obligatoria',
            'date_of_birth.date' => 'Este campo debe ser una fecha válida',
        ];
    }
}
