<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Basket;

class CartFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $sessionString = session('session_string');
        $basket = Basket::where('session', $sessionString)->where('status', 0)->first();

        $rules = [
            'pickup_date' => ['bail', 'required', 'date', 'after_or_equal:today'],
        ];

        if ($basket && $basket->order_type == 'pickup') {
            $rules['pickup_time'] = ['bail', 'required'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'pickup_date.required'         => 'The Date is required.',
            'pickup_date.date'             => 'The Date must be a valid date.',
            'pickup_date.after_or_equal'   => 'The Past dates are not allowed',
            'pickup_time.required'         => 'The Pickup Time is required.',
        ];
    }
}
