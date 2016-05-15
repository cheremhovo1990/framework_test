<?php

/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 14.05.2016
 * Time: 10:39
 */

namespace unit\db\builder;

class WhereHelper extends \PHPUnit_Framework_TestCase
{

    protected function getFromWheres($param, $class)
    {
        $this->where->parser($param);
        $wheres = $this->where->getWheres();
        $this->assertInstanceOf($class, $wheres);
        return $wheres;
    }

    protected function assertSqlStringEquals(string $expect,\app\db\builder\SqlString $obj)
    {
        /* @var $obj \app\db\builder\SqlString */

        $this->assertEquals($expect, $obj->getString());
    }
}