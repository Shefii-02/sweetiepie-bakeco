<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueEmailExceptCurrentUser;

class ProfileDetailsRequest extends FormRequest
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
            'firstname'  => 'bail|required|string|max:255',
            'lastname'   => 'bail|required|string|max:255', 
            'email'      => ['required', 'email', new UniqueEmailExceptCurrentUser],
            'phone'      => 'bail|required|numeric|digits:10',
        ];
    }
    
     public function messages()
    {
         return [
            'phone.required' => 'A phone number is required.',
            'phone.numeric' => 'Phone Number should be numeric.',
            'phone.digits' => 'Phone Number should have exactly 10 digits.',
        ];
    }
    
    public function getValidatorInstance(){
        $this->merge([
            'phone' => str_replace('-','',filter_var($this->phone, FILTER_SANITIZE_NUMBER_INT)),
        ]);
        return parent::getValidatorInstance();
    }
}
