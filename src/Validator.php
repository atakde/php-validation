<?php

namespace Atakde\PhpValidation;

use Atakde\PhpValidation\Exception\InvalidRuleException;

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
            'password' => new Rule\PasswordRule(),
            'required' => new Rule\RequiredRule(),
        ];
    }

    public function validate($rules, $params)
    {
        foreach ($rules as $ruleField => $ruleString) {
            $ruleArray = explode('|', $ruleString);
            foreach ($ruleArray as $rule) {
                if (isset($this->validators[$rule])) {
                    $checkValue = isset($params[$ruleField]) ? $params[$ruleField] : null; // test fail if not doing this for now.
                    if (!$this->validators[$rule]->check($checkValue)) {
                        $this->errors[$ruleField][] = $this->validators[$rule]->getMessage();
                    }
                } else {
                    throw new InvalidRuleException('Rule ' . $rule . ' is not defined');
                }
            }
        }
    }

    public function fails()
    {
        return count($this->errors) > 0;
    }

    public function passes()
    {
        return count($this->errors) === 0;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getValidators()
    {
        return $this->validators;
    }

    public function setRule(Rule\AbstractRule $rule)
    {
        if (!isset($this->validators[$rule->getRuleName()])) {
            $this->validators[$rule->getRuleName()] = $rule;
        }
    }
}
