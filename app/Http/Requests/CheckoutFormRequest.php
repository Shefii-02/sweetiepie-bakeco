<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ConditionalRequired;
use App\Rules\ValidExpirationDate;
use App\Rules\ReCaptchaV3;

class CheckoutFormRequest extends FormRequest
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
        if (auth()->check()) {
            // If authenticated, add rules for card details
            $rules = [
                'billing_address' => 'bail|required',
                'cardNumber' => 'bail|required|numeric',
                'nameOnCard' => 'bail|required|string|max:255',
                'expirationDate' => ['bail', 'required', new ValidExpirationDate],
                'securityCode' => 'bail|required|numeric|digits_between:3,4',
                'g-recaptcha-response' => ['required']
            ];
            
            if ($this->input('same_billing')) {
                $rules += [
                    'shipping_address' => 'bail|required',
                ];
            }
        }
        else
        {
            $rules = [
                'b_firstname' => 'bail|required|string|max:255',
                'b_lastname' => 'bail|required|string|max:255',
                'b_email' => 'bail|required|email:rfc,strict,dns,spoof',
                'b_phone' => 'bail|required|numeric|digits:10',
                'b_address' => 'bail|required',
                'b_postal' => 'bail|required',
                'b_city' => 'bail|required',
                'b_province' => 'bail|required',
                'cardNumber' => 'bail|required|numeric',
                'nameOnCard' => 'bail|required|string|max:255',
                'expirationDate' => ['bail', 'required', new ValidExpirationDate],
                'securityCode' => 'bail|required|numeric|digits_between:3,4',
                'g-recaptcha-response' => ['required']
            ];

            if ($this->input('same_billing')) {
                // If same_billing is selected, add rules for shipping details
                $rules += [
                    's_firstname'   =>  'bail|required|string|max:255',
                    's_lastname'    =>  'bail|required|string|max:255',
                    's_email'       =>  'bail|required|email',
                    's_phone'       =>  'bail|required|numeric|digits:10',
                    's_address'     =>  'bail|required',
                    's_postal'      =>  'bail|required',
                    's_city'        =>  'bail|required',
                    's_province'    =>  'bail|required',
                ];
            } 
            if ($this->input('clickedSignup')) {
                $rules += [
                    'password'	=> 'bail|required|confirmed',
			        'password_confirmation' => 'bail|required',
                ];
            }
        }
        
        
       
        

        return $rules;
    }

    public function messages()
    {
          return [
            'b_firstname.required' => 'The billing first name is required.',
            'b_lastname.required' => 'The billing last name is required.',
            'b_email.required' => 'The billing email address is required.',
            'b_email.email' => 'Please enter a valid billing email address.',
            'b_phone.required' => 'The billing phone number is required.',
            'b_phone.numeric' => 'The billing phone number must be numeric.',
            'b_phone.max' => 'The billing phone number may not be greater than :max characters.',
            'b_address.required' => 'The billing address is required.',
            'b_postal.required' => 'The billing postal code is required.',
            'b_city.required' => 'The billing city is required.',
            'b_province.required' => 'The billing province is required.',

            // Same billing field is nullable, so no custom message is required for it.

            's_firstname.required' => 'The shipping first name is required.',
            's_lastname.required' => 'The shipping last name is required.',
            's_email.required' => 'The shipping email address is required.',
            's_email.email' => 'Please enter a valid shipping email address.',
            's_phone.required' => 'The shipping phone number is required.',
            's_phone.numeric' => 'The shipping phone number must be numeric.',
            's_phone.max' => 'The shipping phone number may not be greater than :max characters.',
            's_address.required' => 'The shipping address is required.',
            's_postal.required' => 'The shipping postal code is required.',
            's_city.required' => 'The shipping city is required.',
            's_province.required' => 'The shipping province is required.',

            'cardNumber.required' => 'The card number is required.',
            'cardNumber.numeric' => 'The card number must be numeric.',
            'nameOnCard.required' => 'The name on card is required.',
            'expirationDate.required' => 'The expiration date is required.',
            'securityCode.required' => 'The security code is required.',
            'securityCode.numeric' => 'The security code must be numeric.',
            'securityCode.max' => 'The security code may not be greater than :max characters.',
            
            'password.required' => 'A password is required.',
            'password.confirmed' => 'Passwords do not match.',
            'password_confirmation.required' => 'Please confirm the password.',
        ];
    }
    
    
    public function getValidatorInstance(){
        $this->merge([
            'b_phone' => str_replace('-','',filter_var($this->b_phone, FILTER_SANITIZE_NUMBER_INT)),
            's_phone' => str_replace('-','',filter_var($this->s_phone, FILTER_SANITIZE_NUMBER_INT)),
        ]);
        return parent::getValidatorInstance();
    }
   
}
