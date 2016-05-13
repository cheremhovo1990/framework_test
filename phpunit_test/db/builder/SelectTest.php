<?php

declare(strict_types=1);

class SelectTest extends PHPUNit_framework_TestCase
{
    private $select;

    public function setUp()
    {
        $this->select = new  \app\db\builder\Select();
    }
    
    public function testParser1()
    {
        $this->select->parser(['first', 'as_second' => 'second', 'third as as_third']);
        $selects = $this->select->getSelects();
        $this->assertEquals('first', $selects[0]->getString());
        $this->assertEquals('second AS as_second', $selects[1]->getString());
        $this->assertEquals('third as as_third', $selects[2]->getString());
    }

    public function testParser2()
    {
        $this->select->parser(['first', 'as_second' => 'second', 'third as as_third']);
        $selects = $this->select->getSelects();
        $this->assertEquals('first', $selects[0]->getString());
        $this->assertEquals('second AS as_second', $selects[1]->getString());
        $this->assertEquals('third as as_third', $selects[2]->getString());
    }
}