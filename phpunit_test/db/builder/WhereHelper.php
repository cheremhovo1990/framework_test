<?php

/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 14.05.2016
 * Time: 10:39
 */

declare(strict_types=1);

namespace unit\db\builder;

class WhereHelper extends Helper
{

    protected function getFromWheres($param, $class)
    {
        $this->where->parser($param);
        $wheres = $this->where->getWhere();
        $this->assertInstanceOf($class, $wheres);
        return $wheres;
    }
}