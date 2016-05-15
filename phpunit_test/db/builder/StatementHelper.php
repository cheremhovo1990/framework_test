<?php

/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 15.05.2016
 * Time: 8:45
 */

declare(strict_types=1);

namespace unit\db\builder;

class StatementHelper extends \PHPUnit_Framework_TestCase
{
    protected function assertSqlStringEquals(string $expect,\app\db\builder\SqlString $obj)
    {
        $this->assertEquals($expect, $obj->getString());
    }
}