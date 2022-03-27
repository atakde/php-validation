<?php

require 'vendor/autoload.php';

use Atakde\PhpValidation\Exception\InvalidRuleException;
use Atakde\PhpValidation\Rule\AbstractRule;
use Atakde\PhpValidation\Rule\EmailRule;
use Atakde\PhpValidation\Rule\EmptyRule;
use Atakde\PhpValidation\Rule\NumericRule;
use Atakde\PhpValidation\Rule\PasswordRule;
use Atakde\PhpValidation\Rule\StringRule;
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
     * We are checking getErrors() method
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
     * Mocking a rule then checking if the rule is added to the validator
     */
    public function testSetRule()
    {
        $stub = $this->getMockForAbstractClass(AbstractRule::class);

        $stub->expects($this->any())
            ->method('check')
            ->with('my test string')
            ->will($this->returnValue(true));

        $stub->expects($this->any())
            ->method('getMessage')
            ->will($this->returnValue(true));

        $stub->expects($this->any())
            ->method('getRuleName')
            ->will($this->returnValue('myRuleName'));

        $stub->ruleName = 'myRuleName';
        $this->validator->setRule($stub);

        $this->assertArrayHasKey('myRuleName', $this->validator->getValidators(), "Validators has not have myRuleName");
    }
}
