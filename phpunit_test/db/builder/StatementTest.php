<?php

declare(strict_types=1);

class StatementTest extends \unit\_helper\Helper
{
    public function testParser()
    {
        $statement = new \app\db\builder\Statement();
        $statement->parser('select', 'first');
        /* @var $select \app\db\builder\Select */
        $select = $statement->getStatements()[0];
        $this->assertInstanceOf(\app\db\builder\Select::class, $select);
        $selects = $select->getSelects();
        $this->assertEquals('first', $selects[0]->getString());

        $statement = new \app\db\builder\Statement();
        $statement->parser('select', ['first', 'as_second' => 'second', 'third as as_third']);
        /* @var $select \app\db\builder\Select */
        $select = $statement->getStatements()[0];
        $this->assertInstanceOf(\app\db\builder\Select::class, $select);
        $selects = $select->getSelects();
        $this->assertEquals('first', $selects[0]->getString());
        $this->assertEquals('second AS as_second', $selects[1]->getString());
        $this->assertEquals('third as as_third', $selects[2]->getString());

        $statement = new \app\db\builder\Statement();
        $statement->parser('from', 'first');
        /* @var $select \app\db\builder\From */
        $from = $statement->getStatements()[0];
        $this->assertInstanceOf(\app\db\builder\From::class, $from);
        $froms = $from->getFroms();
        $this->assertEquals('first', $froms[0]->getString());

        $statement = new \app\db\builder\Statement();
        $statement->parser('from', ['first', 'as_second' => 'second', 'third as as_third']);
        /* @var $select \app\db\builder\From */
        $from = $statement->getStatements()[0];
        $this->assertInstanceOf(\app\db\builder\From::class, $from);
        $froms = $from->getFroms();
        $this->assertEquals('first', $froms[0]->getString());
        $this->assertEquals('second AS as_second', $froms[1]->getString());
        $this->assertEquals('third as as_third', $froms[2]->getString());
    }


}