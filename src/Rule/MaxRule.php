<?php

namespace Atakde\PhpValidation\Rule;

class MaxRule extends AbstractRule
{
    private $ruleName = 'max';

    public function check($value, $params = null)
    {
        return strlen($value) <= $params[0];
    }

    public function getMessage()
    {
        return 'max rule is not valid';
    }

    public function getRuleName()
    {
        return $this->ruleName;
    }
}
