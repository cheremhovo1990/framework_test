<?php

/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 14.05.2016
 * Time: 8:28
 */

declare(strict_types=1);

class FakerOperator extends \fra\db\builder\Operator
{
    public function getNameOperator() : string
    {
        return 'AND';
    }
}

class OperatorTest extends PHPUnit_Framework_TestCase
{
    public $operator;

    public function setUp()
    {
        $this->operator = new FakerOperator();
        $this->operator->setPreparedStatement(new \fra\db\builder\PreparedStatement());
    }

    public function testArrangeStatement1()
    {
        $argument = [
            'param=str1',
            'param=str2',
            [
                'and',
                'param=str3',
                'param=str4',
                [
                    'or',
                    'param=str5', 'param=str6'
                ]
            ]
        ];

        $this->operator->arrangeStatement($argument);
        $expected = '(param=str1 AND param=str2 AND (param=str3 AND param=str4 AND (param=str5 OR param=str6)))';
        $this->assertEquals($expected, $this->operator->buildStatement());
    }
}