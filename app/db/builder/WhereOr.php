<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 12.05.2016
 * Time: 8:49
 */

namespace app\db\builder;


class WhereOr extends Operator
{
    protected function getNameOperator() : string
    {
        return 'OR';
    }
}