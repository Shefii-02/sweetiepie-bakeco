<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressDetailsRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
         return [
            'firstname' => 'bail|required|string|max:255',
            'lastname'  => 'bail|required|string|max:255',
            'address'   => 'bail|required',
            'postalcode'=> 'bail|required|max:7|min:5',
            'city'      => 'bail|required',
            'province'  => 'bail|required'
        ];
    }
    
     public function messages()
    {
         return [
            'firstname.required'    => 'The first name is required.',
            'lastname.required'     => 'The last name is required.',
            'city.required'         => 'The city is required.',
            'postalcode.required'   => 'The postal code is required.',
            'address.required'      => 'The Address is required.',
            'province.required'     => 'The province is required.',
        ];
    }
   
}
