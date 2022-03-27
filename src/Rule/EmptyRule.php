<?php

namespace Atakde\PhpValidation\Rule;

class EmptyRule extends AbstractRule
{
    private $ruleName = 'empty';

    public function check($value)
    {
        return !empty($value);
    }

    public function getMessage()
    {
        return 'The value is empty';
    }

    public function getRuleName()
    {
        return $this->ruleName;
    }
}
