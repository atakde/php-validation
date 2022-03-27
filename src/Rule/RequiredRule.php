<?php

namespace Atakde\PhpValidation\Rule;

class RequiredRule extends AbstractRule
{
    private $ruleName = 'required';

    public function check($value)
    {
        return isset($value);
    }

    public function getMessage()
    {
        return 'The value is required';
    }

    public function getRuleName()
    {
        return $this->ruleName;
    }
}
