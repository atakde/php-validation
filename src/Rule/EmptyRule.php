<?php

namespace Atakde\PhpValidation\Rule;

class EmptyRule extends AbstractRule
{
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
        // TODO: Implement getRuleName() method.
    }
}
