<?php

namespace Atakde\PhpValidation\Rule;

class EmailRule extends AbstractRule
{
    private $ruleName = 'email';

    public function check($value, $params = null)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public function getMessage()
    {
        return 'The value is not a valid email';
    }

    public function getRuleName()
    {
        return $this->ruleName;
    }
}
