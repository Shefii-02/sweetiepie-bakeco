<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ConditionalRequired implements Rule
{
    /**
     * The field that the rule depends on.
     *
     * @var string
     */
    protected $field;

    /**
     * Create a new rule instance.
     *
     * @param  string  $field
     * @return void
     */
    public function __construct($field)
    {
        $this->field = $field;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $otherFieldValue = request()->input($this->field);

        // The field is required if the value of the other field is not null
        return !is_null($otherFieldValue);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute field is required when :other_field is not null.';
    }
}