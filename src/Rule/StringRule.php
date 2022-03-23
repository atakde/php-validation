<?php

namespace Atakde\PhpValidation\Rule;

class StringRule extends AbstractRule
{
    public function check($value)
    {
        return is_string($value);
    }

    public function getMessage()
    {
        return 'The value is not string';
    }
}