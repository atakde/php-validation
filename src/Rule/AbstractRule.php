<?php

namespace Atakde\PhpValidation\Rule;

abstract class AbstractRule
{
    abstract public function check($value);
    abstract public function getMessage();
    abstract public function getRuleName();
}
