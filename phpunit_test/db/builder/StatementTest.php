<?php

declare(strict_types=1);

class StatementTest extends unit\db\builder\StatementHelper
{
    protected $statement;

    public function setUp()
    {
        $this->statement = new \app\db\builder\Statement('select');
    }

    public function testArrangeStatement1()
    {
        /* @var $select \app\db\builder\Select */

        $this->statement->setClass('select');
        $this->statement->arrangeStatement('first');
        $select = $this->statement->getStatements()[0];
        $this->assertInstanceOf(\app\db\builder\Select::class, $select);
        $this->assertSqlStringEquals('first', $select->getTokens()[0]);
    }

    public function testArrangeStatement2()
    {
        /* @var $select \app\db\builder\Select */

        $this->statement->setClass('select');
        $this->statement->arrangeStatement(['first', 'as_second' => 'second', 'third as as_third']);
        $select = $this->statement->getStatements()[0];
        $this->assertInstanceOf(\app\db\builder\Select::class, $select);
        $selects = $select->getTokens();
        $this->assertSqlStringEquals('first', $selects[0]);
        $this->assertSqlStringEquals('second AS as_second', $selects[1]);
        $this->assertSqlStringEquals('third as as_third', $selects[2]);
    }

    public function testArrangeStatement3()
    {
        /* @var $from \app\db\builder\From */

        $this->statement->setClass('from');
        $this->statement->arrangeStatement('first');
        $from = $this->statement->getStatements()[0];
        $this->assertInstanceOf(\app\db\builder\From::class, $from);
        $this->assertSqlStringEquals('first', $from->getTokens()[0]);
    }

    public function testArrangeStatement4()
    {
        /* @var $from \app\db\builder\From */

        $this->statement->setClass('from');
        $this->statement->arrangeStatement(['first', 'as_second' => 'second', 'third as as_third']);
        $from = $this->statement->getStatements()[0];
        $this->assertInstanceOf(\app\db\builder\From::class, $from);
        $froms = $from->getTokens();
        $this->assertSqlStringEquals('first', $froms[0]);
        $this->assertSqlStringEquals('second AS as_second', $froms[1]);
        $this->assertSqlStringEquals('third as as_third', $froms[2]);
    }

    public function testArrangeStatement5()
    {
        /* @var $where \app\db\builder\Where */
        /* @var $and \app\db\builder\WhereAnd */
        /* @var $or \app\db\builder\WhereOr */

        $this->statement->setClass('where');
        $parameter = new \app\db\builder\PreparedStatement();
        $this->statement->setPreparedStatement($parameter);
        $this->statement->arrangeStatement(['str=param1', ['or', 'str=param2']]);
        $where = $this->statement->getStatements()[0];
        $this->assertInstanceOf(\app\db\builder\Where::class, $where);
        $and = $this->getWhereOperator($where, \app\db\builder\WhereAnd::class);
        $this->assertSqlStringEquals('str=param1', $and->getOperator()[0]);
        $or = $and->getOperator()[1];
        $this->assertInstanceOf(\app\db\builder\WhereOr::class, $or);
        $this->assertSqlStringEquals('str=param2', $or->getOperator()[0]);
    }

    /**
     * @expectedException TypeError
     */
    public function testArrangeStatement6()
    {
        $this->statement->setClass('whereAnd');
        $this->statement->arrangeStatement([]);
    }

    /**
     * @expectedException TypeError
     */
    public function testArrangeStatement7()
    {
        $this->statement->setClass('SqlString');
        $this->statement->arrangeStatement([]);
    }

    /**
     * @expectedException TypeError
     */
    public function testArrangeStatement8()
    {
        $this->statement->setClass('Statement');
        $this->statement->arrangeStatement([]);
    }

    public function testArrangeStatement9()
    {
        $parameter = new \app\db\builder\PreparedStatement();
        $parameter->setPreparedStatements([':param1' => 'response1']);
        $this->statement->setPreparedStatement($parameter);

        $this->statement->setClass('where');
        $this->statement->arrangeStatement('str=:param1');
        $where = $this->statement->getStatements()[0];
        $this->assertInstanceOf(\app\db\builder\Where::class, $where);
        $and = $this->getWhereOperator($where, \app\db\builder\WhereAnd::class);
        $identify = \unit\db\builder\Helper::identify();
        $this->assertSqlStringEquals('str=' . $identify, $and->getOperator()[0]);
        $this->assertEquals([$identify => 'response1'], $and->getPreparedStatement()->getPreparedParameters());
    }
}