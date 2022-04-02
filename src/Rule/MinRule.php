<?php

namespace Atakde\PhpValidation\Rule;

class MinRule extends AbstractRule
{
    private $ruleName = 'min';

    public function check($value, $params = null)
    {
        return strlen($value) >= $params[0];
    }

    public function getMessage()
    {
        return 'min rule is not valid';
    }

    public function getRuleName()
    {
        return $this->ruleName;
    }
}
