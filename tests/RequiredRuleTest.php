<?php

require 'vendor/autoload.php';

use Atakde\PhpValidation\Validator;
use PHPUnit\Framework\TestCase;

final class RequiredRuleTest extends TestCase
{
    protected $validator;

    protected function setUp()
    {
        $this->validator = new Validator;
    }

    /**
     * Check required rule is working or not
     */
    public function testRequiredRule()
    {
        $this->validator->validate(['myInput' => 'required'], ['myInput' => '']); // giving correct params
        $this->assertTrue($this->validator->passes());

        $this->validator->validate(['myInput' => 'required'], []); // sending an empty array
        $this->assertTrue($this->validator->fails());
    }
}
