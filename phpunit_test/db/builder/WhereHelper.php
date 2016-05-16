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
    protected function getFromWhere($param, $class)
    {
        $this->where->parser($param);
        $operator = $this->getWhereOperator($this->where, $class);
        return $operator;
    }
}