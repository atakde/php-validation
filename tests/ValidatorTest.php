<?php

require 'vendor/autoload.php';

use Atakde\PhpValidation\Exception\InvalidRuleException;
use Atakde\PhpValidation\Validator;
use PHPUnit\Framework\TestCase;

final class ValidatorTest extends TestCase
{
    protected $validator;

    protected function setUp()
    {
        $this->validator = new Validator;
    }

    /**
     * We are checking passes() function to return true if the validation passes
     */
    public function testPasses()
    {
        $this->validator->validate(['password' => 'password'], ['password' => 'AN4d$QDMa9-]7jH9']);
        $this->assertTrue($this->validator->passes());

        $this->validator->validate(['password' => 'password'], ['password' => '123']);
        $this->assertFalse($this->validator->passes());
    }

    /**
     * We are checking fails() function to return true if the validation fails
     */
    public function testFails()
    {
        $this->validator->validate(['password' => 'password|string'], ['password' => 'AN4d$QDMa9-]7jH9']);
        $this->assertFalse($this->validator->fails());

        $this->validator->validate(['password' => 'password|string'], ['password' => '123']);
        $this->assertTrue($this->validator->fails());
    }

    /**
     * We are checking InvalidRuleException if the rule is not defined
     */
    public function testInvalidRule()
    {
        $this->expectException(InvalidRuleException::class);
        $this->validator->validate(['myInput' => 'int'], ['myInput' => 'my test string']);
    }

    /**
     * We are checking passes() function for multiple rules
     */
    public function testPassesWithMultipleValidationRules()
    {
        $this->validator->validate(
            [
                'email' => 'email|string',
                'myNumberInput' => 'numeric'
            ],
            [
                'email' => 'me@atakann.com',
                'myNumberInput' => 123
            ]
        );
        $this->assertTrue($this->validator->passes());

        $this->validator->validate(
            [
                'email' => 'email|string',
                'myNumberInput' => 'numeric'
            ],
            [
                'email' => 'atakann.com', // email is not valid here.
                'myNumberInput' => 123
            ]
        );

        $this->assertFalse($this->validator->passes());

        $this->validator->validate(
            [
                'email' => 'email|string',
                'myNumberInput' => 'numeric'
            ],
            [
                'email' => 'me@atakann.com',
                'myNumberInput' => "one" // numeric is not valid here.
            ]
        );

        $this->assertFalse($this->validator->passes());
    }

    /**
     * We are checking get Errors method
     */
    public function testGetErrors()
    {
        $this->validator->validate(['myInput' => 'numeric'], ['myInput' => 'my test string']);
        $this->assertEquals($this->validator->getErrors(), [
            'myInput' => [
                'The value is not numeric'
            ]
        ]);
    }

    /**
     * We are checking get Errors method
     */
    public function testSetRule()
    {
        $this->validator->validate(['myInput' => 'numeric'], ['myInput' => 'my test string']);
        $this->assertEquals($this->validator->getErrors(), [
            'myInput' => [
                'The value is not numeric'
            ]
        ]);
    }
}
