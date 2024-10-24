<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\MaxFileSize;
class CareerFormRequest extends FormRequest
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
            'location'   => 'bail|required',
            'firstname'   => 'bail|required|string|max:255',
            'lastname'   => 'bail|required|string|max:255',
            'email'      => 'bail|required|email',
            'phone'     => 'bail|required|numeric|digits:10',
            'descrption'    => 'bail|required|max:255',
            'resume' => ['nullable', 'file', new MaxFileSize(5000, ['pdf', 'docx', 'doc'])],
            'availability' => 'bail|required',
        ];
    }
    
    public function messages()
    {
        return [
            
            'location.required' => 'The Location field is required.',
            'firstname.required' => 'The First Name field is required.',
            'firstname.string' => 'The First Name must be a string.',
            'firstname.max' => 'The First Name may not be greater than :max characters.',
            
            'lastname.required' => 'The Last Name field is required.',
            'lastname.string' => 'The Last Name must be a string.',
            'lastname.max' => 'The Last Name may not be greater than :max characters.',
            
            'email.required' => 'The Email Address field is required.',
            'email.email' => 'Please enter a valid Email Address.',
            
            'phone.required' => 'The Contact Number field is required.',
            'phone.numeric' => 'The Contact Number must be numeric.',
            'phone.digits' => 'The Contact Number must be exactly :digits digits.',
            
            'descrption.required' => 'The Description field is required.',
            'descrption.max' => 'The Description may not be greater than :max characters.',
            'availability' => 'The Availability field is required.',
            'resume.file' => 'The uploaded file is not valid.',
        ];
    }
     
    public function getValidatorInstance(){
        $this->merge([
            'phone' => str_replace('-','',filter_var($this->phone, FILTER_SANITIZE_NUMBER_INT)),
        ]);
        return parent::getValidatorInstance();
    }
}


