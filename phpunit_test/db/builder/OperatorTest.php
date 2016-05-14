<?php

/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 14.05.2016
 * Time: 8:28
 */

declare(strict_types=1);

class FakerOperator extends \app\db\builder\Operator
{

}

class OperatorTest extends PHPUnit_Framework_TestCase
{
    public $operator;

    public function setUp()
    {
        $this->operator = new FakerOperator();
    }

    public function testParser1()
    {
        $this->operator->parser(['param=str1', ['or', 'param=str2', ['and', 'param=str3']]]);
        /* @var $string \app\db\builder\SqlString */
        $string = $this->operator->getOperator()[0];
        $this->assertInstanceOf(\app\db\builder\SqlString::class, $string);
        $this->assertEquals('param=str1', $string->getString());
        /* @var $or \app\db\builder\WhereOr */
        $or = $this->operator->getOperator()[1];
        $this->assertInstanceOf(\app\db\builder\WhereOr::class, $or);
        /* @var $string \app\db\builder\SqlString */
        $string = $or->getOperator()[0];
        $this->assertInstanceOf(\app\db\builder\SqlString::class, $string);
        $this->assertEquals('param=str2', $string->getString());
        /* @var $and \app\db\builder\WhereAnd */
        $and = $or->getOperator()[1];
        $this->assertInstanceOf(\app\db\builder\WhereAnd::class, $and);
        /* @var $string \app\db\builder\SqlString */
        $string = $and->getOperator()[0];
        $this->assertInstanceOf(\app\db\builder\SqlString::class, $string);
        $this->assertEquals('param=str3', $string->getString());
    }
}