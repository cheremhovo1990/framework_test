<?php

declare(strict_types=1);

class FromTest extends PHPUNit_framework_TestCase
{
    private $from;

    public function setUp()
    {
        $this->from = new \app\db\builder\Select();
    }
    
    public function testParser1()
    {
        $this->from->parser('first');
        $from = $this->from->getSelects()[0]->getString();
        $this->assertEquals('first', $from );
    }

    public function testParser2()
    {
        $this->from->parser(['first', 'as_second' => 'second', 'third as as_third']);
        $from = $this->from->getSelects();
        $this->assertEquals('first', $from[0]->getString());
        $this->assertEquals('second AS as_second', $from[1]->getString());
        $this->assertEquals('third as as_third', $from[2]->getString());
    }
}