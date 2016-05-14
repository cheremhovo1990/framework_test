<?php

declare(strict_types=1);

class WhereTest extends unit\db\builder\WhereHelper
{
    private $where;

    public function setUp()
    {
        $this->where = new app\db\builder\Where();
    }

    public function testParser1()
    {
        /* @var $and \app\db\builder\WhereAnd*/
        /* @var $string \app\db\builder\SqlString */

        $and = $this->getFromWheres('param', \app\db\builder\WhereAnd::class);
        $string = $and->getOperator()[0];
        $this->assertInstanceOf(\app\db\builder\SqlString::class, $string);
        $this->assertEquals('param', $string->getString());
    }

    public function testParser2()
    {
        /* @var $or \app\db\builder\WhereOr */
        /* @var $string \app\db\builder\SqlString */

        $or = $this->getFromWheres(['or', 'str=param1', ['or', 'str=param2']], \app\db\builder\WhereOr::class);
        $string = $or->getOperator()[0];
        $this->assertEquals('str=param1', $string->getString());
        $or = $or->getOperator()[1];
        $this->assertInstanceOf(\app\db\builder\WhereOr::class, $or);
        $string = $or->getOperator()[0];
        $this->assertEquals('str=param2', $string->getString());
    }

    public function testParser3()
    {
        /* @var $and \app\db\builder\WhereAnd*/
        /* @var $string \app\db\builder\SqlString*/

        $and = $this->getFromWheres(['and', 'str=param1', ['and', 'str=param2']], \app\db\builder\WhereAnd::class);
        $string = $and->getOperator()[0];
        $this->assertEquals('str=param1', $string->getString());
        $and = $and->getOperator()[1];
        $this->assertInstanceOf(\app\db\builder\WhereAnd::class, $and);
        $string = $and->getOperator()[0];
        $this->assertEquals('str=param2', $string->getString());
    }

    protected function getFromWheres($param, $class)
    {
        $this->where->parser($param);
        $wheres = $this->where->getWheres();
        $this->assertInstanceOf($class, $wheres);
        return $wheres;
    }
}