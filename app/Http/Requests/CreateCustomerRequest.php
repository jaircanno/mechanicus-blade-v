<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'rfc' => '',
            'email' => '',
            'cell_phone_number' => '',
        ];
    }

    /**
     * Get the specific messages for errors.
     *
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
          'first_name.required' => 'Ingrese Nombre(s) del cliente',
          'last_name.required' => 'Ingrese Apellido(s) del cliente',
        ];
    }
}