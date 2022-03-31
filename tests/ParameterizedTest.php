<?php

require 'vendor/autoload.php';

use Atakde\PhpValidation\Validator;
use PHPUnit\Framework\TestCase;

final class ParameterizedTest extends TestCase
{
    protected $validator;

    protected function setUp()
    {
        $this->validator = new Validator;
    }

    /**
     * @dataProvider provider
     */
    public function testAdd($params, $rules)
    {
        $this->validator->validate($params, $rules); // giving a string value
        $this->assertTrue($this->validator->passes());
    }

    public function provider()
    {
        return [
            [['myInput' => 'required|string'], ['myInput' => 'my string']],
            [['myInput' => 'required|numeric'], ['myInput' => '123']],
            [['myInput' => 'required|email'], ['myInput' => 'me@atakann.com']]
        ];
    }
}
