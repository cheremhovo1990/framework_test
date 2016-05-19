<?php

declare(strict_types=1);

class WhereTest extends unit\db\builder\WhereHelper
{
    protected $where;

    public function setUp()
    {
        $this->where = new app\db\builder\Where();
        $this->where->setPreparedStatement(new \app\db\builder\PreparedStatement());
    }

    public function testParser1()
    {
        /* @var $and \app\db\builder\WhereAnd*/

        $and = $this->getFromWhere('param', \app\db\builder\WhereAnd::class);
        $this->assertSqlStringEquals('param', $and->getOperator()[0]);
    }

    public function testParser2()
    {
        /* @var $or \app\db\builder\WhereOr */

        $or = $this->getFromWhere(['or', 'str=param1', ['or', 'str=param2']], \app\db\builder\WhereOr::class);
        $this->assertSqlStringEquals('str=param1', $or->getOperator()[0]);
        $or = $or->getOperator()[1];
        $this->assertInstanceOf(\app\db\builder\WhereOr::class, $or);
        $this->assertSqlStringEquals('str=param2', $or->getOperator()[0]);
    }

    public function testParser3()
    {
        /* @var $and \app\db\builder\WhereAnd*/

        $and = $this->getFromWhere(['and', 'str=param1', ['and', 'str=param2']], \app\db\builder\WhereAnd::class);
        $this->assertSqlStringEquals('str=param1', $and->getOperator()[0]);
        $and = $and->getOperator()[1];
        $this->assertInstanceOf(\app\db\builder\WhereAnd::class, $and);
        $this->assertSqlStringEquals('str=param2', $and->getOperator()[0]);
    }

    /**
     * @expectedException TypeError
    */
    public function testParser4()
    {
        $this->where->parser(['', 'str=param1']);
    }

    public function testParser5()
    {
        $and = $this->getFromWhere(['and', 'str1' => 'param1'], \app\db\builder\WhereAnd::class);
        $identify = \unit\db\builder\Helper::identify();
        $this->assertSqlStringEquals('str1=' . $identify, $and->getOperator()[0]);
        $this->assertEquals([$identify => 'param1'], $and->getPreparedStatement()->getPreparedParameters());
    }
}