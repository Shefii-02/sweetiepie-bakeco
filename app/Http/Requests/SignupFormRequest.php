<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupFormRequest extends FormRequest
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
            'email'      => 'bail|required|email|unique:users,email',
            'password'	=> 'bail|required|confirmed',
			'password_confirmation' => 'bail|required',
            'phone'      => 'bail|required|numeric|digits:10',
            'city'    => 'bail|required',
            'postalcode'    => 'bail|required',
            'dob' => 'bail|required|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
            'required_terms' => 'bail|required',
            'g-recaptcha-response' => ['required']
        ];
    }
    
     public function messages()
    {
         return [
            'firstname.required' => 'The first name is required.',
            'lastname.required' => 'The last name is required.',
            'email.required' => 'The email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email address is already in use.',
            'password.required' => 'A password is required.',
            'password.confirmed' => 'Passwords do not match.',
            'password_confirmation.required' => 'Please confirm the password.',
            'phone.required' => 'A phone number is required.',
            'phone.numeric' => 'Phone Number should be numeric.',
            'phone.digits' => 'Phone Number should have exactly 10 digits.',
            'city.required' => 'The city is required.',
            'postalcode.required' => 'The postal code is required.',
            'dob.before_or_equal' => 'You must be at least 18 years old.',
            'g-recaptcha-response.required' => 'Please complete the reCAPTCHA challenge.'
        ];
    }
    
    public function getValidatorInstance(){
        $this->merge([
            'phone' => str_replace('-','',filter_var($this->phone, FILTER_SANITIZE_NUMBER_INT)),
        ]);
        return parent::getValidatorInstance();
    }
}
