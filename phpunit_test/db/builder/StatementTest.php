<?php

declare(strict_types=1);

class StatementTest extends PHPUNit_framework_TestCase
{
    private $statement;

    public function setUp()
    {
        $this->statement = new \app\db\builder\Statement();
    }

    public function testParser1()
    {
        $this->statement->parser('select', 'first');
        /* @var $select \app\db\builder\Select */
        $select = $this->statement->getStatements()[0];
        $this->assertInstanceOf(\app\db\builder\Select::class, $select);
        $selects = $select->getTokens();
        $this->assertEquals('first', $selects[0]->getString());
    }

    public function testParser2()
    {
        $this->statement->parser('select', ['first', 'as_second' => 'second', 'third as as_third']);
        /* @var $select \app\db\builder\Select */
        $select = $this->statement->getStatements()[0];
        $this->assertInstanceOf(\app\db\builder\Select::class, $select);
        $selects = $select->getTokens();
        $this->assertEquals('first', $selects[0]->getString());
        $this->assertEquals('second AS as_second', $selects[1]->getString());
        $this->assertEquals('third as as_third', $selects[2]->getString());
    }

    public function testParser3()
    {
        $this->statement->parser('from', 'first');
        /* @var $select \app\db\builder\From */
        $from = $this->statement->getStatements()[0];
        $this->assertInstanceOf(\app\db\builder\From::class, $from);
        $froms = $from->getTokens();
        $this->assertEquals('first', $froms[0]->getString());
    }

    public function testParser4()
    {
        $this->statement->parser('from', ['first', 'as_second' => 'second', 'third as as_third']);
        /* @var $select \app\db\builder\From */
        $from = $this->statement->getStatements()[0];
        $this->assertInstanceOf(\app\db\builder\From::class, $from);
        $froms = $from->getTokens();
        $this->assertEquals('first', $froms[0]->getString());
        $this->assertEquals('second AS as_second', $froms[1]->getString());
        $this->assertEquals('third as as_third', $froms[2]->getString());
    }

    public function testParser5()
    {
        $this->statement->parser('where', ['str=param1', ['or', 'str=param2']]);
        /* @var $where \app\db\builder\Where */
        $where = $this->statement->getStatements()[0];
        $this->assertInstanceOf(\app\db\builder\Where::class, $where);
        /* @var $and \app\db\builder\WhereAnd */
        $and = $where->getWheres();
        $this->assertInstanceOf(\app\db\builder\WhereAnd::class, $and);
        /* @var $string \app\db\builder\SqlString */
        $string = $and->getOperator()[0];
        $this->assertInstanceOf(\app\db\builder\SqlString::class, $string);
        $this->assertEquals('str=param1', $string->getString());
        /* @var $or \app\db\builder\WhereOr */
        $or = $and->getOperator()[1];
        /* @var $string \app\db\builder\SqlString */
        $string = $or->getOperator()[0];
        $this->assertInstanceOf(\app\db\builder\SqlString::class, $string);
        $this->assertEquals('str=param2', $string->getString());
    }

}