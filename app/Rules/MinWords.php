<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MinWords implements ValidationRule
{
    private $excpected;
    public function __construct($excpected)
    {
        $this->excpected = $excpected;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $words = explode(' ', $value);
        if (count($words) < $this->excpected) {
            $fail('The :attribute must be at least '. $this->excpected .' words.');
        }
    }
}
