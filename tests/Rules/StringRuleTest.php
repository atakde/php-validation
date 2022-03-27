<?php

require 'vendor/autoload.php';

use Atakde\PhpValidation\Validator;
use PHPUnit\Framework\TestCase;

final class StringRuleTest extends TestCase
{
    protected $validator;

    protected function setUp()
    {
        $this->validator = new Validator;
    }

    /**
     * Check string rule is working or not
     */
    public function testEmptyRule()
    {
        $this->validator->validate(['myInput' => 'string'], ['myInput' => 'my string']); // giving a string value
        $this->assertTrue($this->validator->passes());

        $this->validator->validate(['myInput' => 'string'], ['myInput' => 123]); // giving a number value
        $this->assertTrue($this->validator->fails());
    }
}
