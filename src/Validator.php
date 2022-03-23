<?php

namespace Atakde\PhpValidation;

use Atakde\PhpValidation\Exception\InvalidRuleException;
use Exception;

class Validator
{
    public $validators = [];
    public $errors = [];

    public function __construct()
    {
        $this->validators = [
            'empty' => new Rule\EmptyRule(),
            'numeric' => new Rule\NumericRule(),
            'string' => new Rule\StringRule(),
            'email' => new Rule\EmailRule(),
            'password' => new Rule\PasswordRule()
        ];
    }

    public function validate($fields, $value)
    {
        try {
            foreach ($fields as $field => $rules) {
                $rules = explode('|', $rules);

                foreach ($rules as $rule) {
                    if (isset($this->validators[$rule])) {
                        if (!$this->validators[$rule]->check($value)) {
                            $this->errors[$field][] = $this->validators[$rule]->getMessage();
                        }
                    } else {
                        throw new InvalidRuleException('Rule ' . $rule . ' is not defined');
                    }
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }

        return empty($this->errors);
    }
}
