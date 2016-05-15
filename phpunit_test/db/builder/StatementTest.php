<?php

declare(strict_types=1);

class StatementTest extends unit\db\builder\StatementHelper
{
    protected $statement;

    public function setUp()
    {
        $this->statement = new \app\db\builder\Statement();
    }

    public function testParser1()
    {
        /* @var $select \app\db\builder\Select */

        $this->statement->parser('select', 'first');
        $select = $this->statement->getStatements()[0];
        $this->assertInstanceOf(\app\db\builder\Select::class, $select);
        $this->assertSqlStringEquals('first', $select->getTokens()[0]);
    }

    public function testParser2()
    {
        /* @var $select \app\db\builder\Select */

        $this->statement->parser('select', ['first', 'as_second' => 'second', 'third as as_third']);
        $select = $this->statement->getStatements()[0];
        $this->assertInstanceOf(\app\db\builder\Select::class, $select);
        $selects = $select->getTokens();
        $this->assertSqlStringEquals('first', $selects[0]);
        $this->assertSqlStringEquals('second AS as_second', $selects[1]);
        $this->assertSqlStringEquals('third as as_third', $selects[2]);
    }

    public function testParser3()
    {
        /* @var $from \app\db\builder\From */

        $this->statement->parser('from', 'first');
        $from = $this->statement->getStatements()[0];
        $this->assertInstanceOf(\app\db\builder\From::class, $from);
        $this->assertSqlStringEquals('first', $from->getTokens()[0]);
    }

    public function testParser4()
    {
        /* @var $from \app\db\builder\From */

        $this->statement->parser('from', ['first', 'as_second' => 'second', 'third as as_third']);
        $from = $this->statement->getStatements()[0];
        $this->assertInstanceOf(\app\db\builder\From::class, $from);
        $froms = $from->getTokens();
        $this->assertSqlStringEquals('first', $froms[0]);
        $this->assertSqlStringEquals('second AS as_second', $froms[1]);
        $this->assertSqlStringEquals('third as as_third', $froms[2]);
    }

    public function testParser5()
    {
        /* @var $where \app\db\builder\Where */
        /* @var $and \app\db\builder\WhereAnd */
        /* @var $or \app\db\builder\WhereOr */

        $this->statement->parser('where', ['str=param1', ['or', 'str=param2']]);
        $where = $this->statement->getStatements()[0];
        $this->assertInstanceOf(\app\db\builder\Where::class, $where);
        $and = $where->getWheres();
        $this->assertInstanceOf(\app\db\builder\WhereAnd::class, $and);
        $this->assertSqlStringEquals('str=param1', $and->getOperator()[0]);
        $or = $and->getOperator()[1];
        $this->assertInstanceOf(\app\db\builder\WhereOr::class, $or);
        $this->assertSqlStringEquals('str=param2', $or->getOperator()[0]);
    }
}