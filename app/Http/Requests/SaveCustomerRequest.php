<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveCustomerRequest extends FormRequest
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
            // Customer
            'first_name'        => 'required',
            'last_name'         => 'required',
            'rfc'               => '',
            'email'             => 'required|string|email|max:255|unique:users',
            'cell_phone_number' => '',
            // Address
            'street_address'    => 'required',
            'outdoor_number'    => 'required|numeric',
            'interior_number'   => '',
            'colony'            => 'required',
            'postal_code'       => 'required|numeric',
            'city'              => 'required',
            'state'             => 'required',
            'country'           => 'required',
            'phone_number'      => '',
            'fax_number'        => '',
        ];
    }

    /**
     * Get the specific messages for errors.
     *
     * @return array|string[]
     */
    public function messages(): array
    {
        return [];
    }
}
