<?php

namespace Atakde\PhpValidation\Rule;

/**
 *^: anchored to beginning of string
 *\S*: any set of characters
 *(?=\S{8,}): of at least length 8
 *(?=\S*[a-z]): containing at least one lowercase letter
 *(?=\S*[A-Z]): and at least one uppercase letter
 *(?=\S*[\d]): and at least one number
 *$: anchored to the end of the string
 */

class PasswordRule extends AbstractRule
{
    private $ruleName = 'password';

    public function check($value, $params = null)
    {
        return preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $value);
    }

    public function getMessage()
    {
        return 'The value is not a valid password';
    }

    public function getRuleName()
    {
        return $this->ruleName;
    }
}
