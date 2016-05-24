<?php

declare(strict_types=1);

class WhereTest extends PHPUnit_Framework_TestCase
{
    protected $where;

    public function setUp()
    {
        $this->where = new fra\db\builder\Where();
        $this->where->setPreparedStatement(new \fra\db\builder\PreparedStatement());
    }

    public function testArrangeStatement1()
    {
        $this->where->arrangeStatement('param');
        $this->assertEquals(' WHERE (param)', $this->where->buildStatement());
    }

    public function testArrangeStatement2()
    {
        $this->where->arrangeStatement(['or', 'str=param1', ['or', 'str=param2']]);
        $this->assertEquals(' WHERE (str=param1 OR (str=param2))', $this->where->buildStatement());
    }

    public function testArrangeStatement3()
    {
        $this->where->arrangeStatement(['and', 'str=param1', ['and', 'str=param2']]);
        $this->assertEquals(' WHERE (str=param1 AND (str=param2))', $this->where->buildStatement());
    }

    /**
     * @expectedException TypeError
    */
    public function testArrangeStatement4()
    {
        $this->where->arrangeStatement(['', 'str=param1']);
    }

    public function testArrangeStatement5()
    {
        $this->where->arrangeStatement(['and', 'str1' => 'param1']);
        $identify = \unit\db\builder\Helper::identify();
        $this->assertEquals(' WHERE (str1=' . $identify . ')', $this->where->buildStatement());
        $this->assertEquals([$identify => 'param1'], $this->where->getPreparedStatement()->getPreparedParameters());
    }
}