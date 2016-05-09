<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 09.05.2016
 * Time: 9:37
 */

class StatementTest extends \unit\_helper\Helper
{
    public function testParser()
    {
        $statement = new \app\db\builder\Statement();
        $statement->parser('select', 'first');
        /* @var $select \app\db\builder\Select */
        $select = $statement->getStatements()[0];
        $selects = $select->getSelects();
        $this->assertEquals('first', $selects[0]->getString());

        $statement = new \app\db\builder\Statement();
        $statement->parser('select', ['first', 'as_second' => 'second', 'third as as_third']);
        /* @var $select \app\db\builder\Select */
        $select = $statement->getStatements()[0];
        $selects = $select->getSelects();
        $this->assertEquals('first', $selects[0]->getString());
        $this->assertEquals('second AS as_second', $selects[1]->getString());
        $this->assertEquals('third as as_third', $selects[2]->getString());
    }
}