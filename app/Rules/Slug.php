<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Slug implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $pattern = '/^[a-z0-9-_]+$/';

        if (!preg_match($pattern, $value)) {
            $fail('Please use only lowercase letters, numbers, hyphens, and underscores.');
        };
    }
}
