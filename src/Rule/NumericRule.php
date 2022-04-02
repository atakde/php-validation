<?php

namespace Atakde\PhpValidation\Rule;

class NumericRule extends AbstractRule
{
    private $ruleName = 'numeric';

    public function check($value, $params = null)
    {
        return is_numeric($value);
    }

    public function getMessage()
    {
        return 'The value is not numeric';
    }

    public function getRuleName()
    {
        return $this->ruleName;
    }
}
