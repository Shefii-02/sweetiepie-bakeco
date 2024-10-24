<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ReCaptcha;

class EnquiryRequest extends FormRequest
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
            'firstname'    => 'bail|required|string|max:255',
            'lastname'     => 'bail|sometimes|nullable|string|max:255',
            'email'        => 'bail|required|email',
            'phone'        => 'bail|required|numeric|digits:10',
            'company_name' => 'bail|required',
            'address' => 'bail|required',
            'city' => 'bail|required',
            'postalcode' => 'bail|required',
            'province' => 'bail|required',
            'g-recaptcha-response' => ['required']

        ];
    }

    public function messages()
    {
        return [
            'firstname.required'    => 'The First Name is required.',
            'lastname.required'     => 'The Last Name is required.',
            'email.required'        => 'The Email Address is required.',
            'email.email'           => 'Please enter a valid Email Address.',
            'phone.required'       => 'The Contact Number is required.',
            'phone.numeric'        => 'The Contact Number must be numeric.',
            'phone.max'            => 'The Contact Number must not be greater than :max.',
            'company_name.required' => 'The company name field is required.',  
            'g-recaptcha-response.required' => 'Please complete the reCAPTCHA challenge.',
        ];
    }
     public function getValidatorInstance(){
        $this->merge([
            'phone' => str_replace('-','',filter_var($this->phone, FILTER_SANITIZE_NUMBER_INT)),
        ]);
        return parent::getValidatorInstance();
    }
}
