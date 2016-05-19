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

class OperatorTest extends \unit\db\builder\OperatorHelper
{
    public $operator;

    public function setUp()
    {
        $this->operator = new FakerOperator();
        $this->operator->setPreparedStatement(new \app\db\builder\PreparedStatement());
    }

    public function testParser1()
    {
        /* @var $or \app\db\builder\WhereOr */
        /* @var $and \app\db\builder\WhereAnd */

        $this->operator->parser(['param=str1', ['or', 'param=str2', ['and', 'param=str3']]]);
        $this->assertSqlStringEquals('param=str1', $this->operator->getOperator()[0]);
        $or = $this->operator->getOperator()[1];
        $this->assertInstanceOf(\app\db\builder\WhereOr::class, $or);
        $this->assertSqlStringEquals('param=str2', $or->getOperator()[0]);
        $and = $or->getOperator()[1];
        $this->assertInstanceOf(\app\db\builder\WhereAnd::class, $and);
        $this->assertSqlStringEquals('param=str3', $and->getOperator()[0]);
    }
}