<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 12.05.2016
 * Time: 8:26
 */

declare(strict_types=1);

namespace fra\db\builder;


class WhereAnd extends Operator
{
    protected function getNameOperator() : string
    {
        return 'AND';
    }
}