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

}