<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 15.05.2016
 * Time: 9:00
 */

declare(strict_types=1);

namespace unit\db\builder;


class OperatorHelper extends \PHPUnit_Framework_TestCase
{
    protected function assertSqlStringEquals(string $expect,\app\db\builder\SqlString $obj)
    {
        $this->assertEquals($expect, $obj->getString());
    }
}