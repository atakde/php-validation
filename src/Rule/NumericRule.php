<?php

namespace Atakde\PhpValidation\Rule;

class NumericRule extends AbstractRule
{
    public function check($value)
    {
        return is_numeric($value);
    }

    public function getMessage()
    {
        return 'The value is not numeric';
    }
}
