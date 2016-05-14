<?php

declare(strict_types=1);

class WhereTest extends PHPUNit_framework_TestCase
{
    private $where;

    public function setUp()
    {
        $this->where = new app\db\builder\Where();
    }
    
    public function testParser1()
    {
        $this->where->parser('param');
        $wheres = $this->where->getWheres();
        $ands = $wheres->getOperator();
        $this->assertEquals('param', $ands[0]->getString());
    }

    public function testParser2()
    {
        $this->where->parser(['or', 'str=param1', ['or', 'str=param2']]);
        $wheres = $this->where->getWheres();
        $ors = $wheres->getOperator();
        $this->assertEquals('str=param1', $ors[0]->getString());
        $ors = $ors[1]->getOperator();
        $this->assertEquals('str=param2', $ors[0]->getString());
    }

    public function testParser3()
    {
        $this->where->parser(['and', 'str=param1', ['and', 'str=param2']]);
        $wheres = $this->where->getWheres();
        $ors = $wheres->getOperator();
        $this->assertEquals('str=param1', $ors[0]->getString());
        $ors = $ors[1]->getOperator();
        $this->assertEquals('str=param2', $ors[0]->getString());
    }
}