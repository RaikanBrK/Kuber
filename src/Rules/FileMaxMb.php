<?php

namespace Kuber\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class FileMaxMb implements ValidationRule
{
    protected $maxSize;

    public function __construct($maxSize)
    {
        $this->maxSize = $maxSize;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value->getSize() / 1024 > $this->maxSize * 1024) {
            $fail($this->message());
        }
    }

    public function message()
    {
        return __('validation.max.fileMb', ['max' => $this->maxSize]);
    }
}