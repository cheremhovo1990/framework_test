<?php

declare(strict_types=1);

class WhereTest extends unit\db\builder\WhereHelper
{
    protected $where;

    public function setUp()
    {
        $this->where = new app\db\builder\Where();
    }

    public function testParser1()
    {
        /* @var $and \app\db\builder\WhereAnd*/

        $and = $this->getFromWheres('param', \app\db\builder\WhereAnd::class);
        $this->assertSqlStringEquals('param', $and->getOperator()[0]);
    }

    public function testParser2()
    {
        /* @var $or \app\db\builder\WhereOr */

        $or = $this->getFromWheres(['or', 'str=param1', ['or', 'str=param2']], \app\db\builder\WhereOr::class);
        $this->assertSqlStringEquals('str=param1', $or->getOperator()[0]);
        $or = $or->getOperator()[1];
        $this->assertInstanceOf(\app\db\builder\WhereOr::class, $or);
        $this->assertSqlStringEquals('str=param2', $or->getOperator()[0]);
    }

    public function testParser3()
    {
        /* @var $and \app\db\builder\WhereAnd*/

        $and = $this->getFromWheres(['and', 'str=param1', ['and', 'str=param2']], \app\db\builder\WhereAnd::class);
        $this->assertSqlStringEquals('str=param1', $and->getOperator()[0]);
        $and = $and->getOperator()[1];
        $this->assertInstanceOf(\app\db\builder\WhereAnd::class, $and);
        $this->assertSqlStringEquals('str=param2', $and->getOperator()[0]);
    }
}