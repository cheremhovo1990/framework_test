<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 07.05.2016
 * Time: 9:21
 */

namespace app\db;


class StatementSelect extends Statement implements
    SelectFromWhere
{
    public function add($statement)
    {
        $this->statements[] = $statement;
    }
}