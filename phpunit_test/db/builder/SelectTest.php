<?php

class SelectTest extends \unit\_helper\Helper
{
    public function testParser()
    {
        $select = new \app\db\builder\Select();
        $select->parser('first');
        $selects = $select->getSelects()[0]->getString();
        $this->assertEquals('first', $selects);

        $select = new \app\db\builder\Select();
        $select->parser(['first', 'as_second' => 'second', 'third as as_third']);
        $selects = $select->getSelects();
        $this->assertEquals('first', $selects[0]->getString());
        $this->assertEquals('second AS as_second', $selects[1]->getString());
        $this->assertEquals('third as as_third', $selects[2]->getString());
    }
}