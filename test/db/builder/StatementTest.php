<?php

declare(strict_types=1);

class StatementTest extends PHPUnit_Framework_TestCase
{
    protected $statement;

    public function setUp()
    {
        $this->statement = new \fra\db\builder\Statement('select');
        $shield = new \fra\db\builder\Shield();
        $this->statement->setShield($shield);
    }

    public function testArrangeStatement1()
    {
        $this->statement->setClass('select');
        $this->statement->arrangeStatement('first');
        $this->assertEquals('SELECT `first`', $this->statement->buildStatement());
    }

    public function testArrangeStatement2()
    {
        $this->statement->setClass('select');
        $this->statement->arrangeStatement(['first', 'as_second' => 'second', 'third as as_third']);
        $this->assertEquals('SELECT `first`, `second` AS `as_second`, `third` AS `as_third`', $this->statement->buildStatement());
    }

    public function testArrangeStatement3()
    {
        $this->statement->setClass('from');
        $this->statement->arrangeStatement('first');
        $this->assertEquals(' FROM `first`', $this->statement->buildStatement());
    }

    public function testArrangeStatement4()
    {
        $this->statement->setClass('from');
        $this->statement->arrangeStatement(['first', 'as_second' => 'second', 'third as as_third']);
        $this->assertEquals(' FROM `first`, `second` AS `as_second`, `third` AS `as_third`', $this->statement->buildStatement());
    }

    public function testArrangeStatement5()
    {
        $this->statement->setClass('where');
        $parameter = new \fra\db\builder\PreparedStatement();
        $this->statement->setPreparedStatement($parameter);
        $this->statement->arrangeStatement(['str=param1', ['or', 'str=param2']]);
        $this->assertEquals(' WHERE (str=param1 AND (str=param2))', $this->statement->buildStatement());
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
        $parameter = new \fra\db\builder\PreparedStatement();
        $parameter->setPreparedStatements([':param1' => 'response1']);
        $this->statement->setPreparedStatement($parameter);
        $this->statement->setClass('where');
        $this->statement->arrangeStatement('str=:param1');
        $identify = \unit\db\builder\Helper::identify();
        $this->assertEquals(' WHERE (str='. $identify . ')', $this->statement->buildStatement());
        $this->assertEquals([$identify => 'response1'], $this->statement->getPreparedStatement()->getPreparedParameters());
    }
}