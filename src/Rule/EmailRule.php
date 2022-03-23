<?php

namespace Atakde\PhpValidation\Rule;

class EmailRule extends AbstractRule
{
    public function check($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public function getMessage()
    {
        return 'The value is not a valid email';
    }
}
