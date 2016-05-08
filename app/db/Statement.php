<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 07.05.2016
 * Time: 9:06
 */

namespace app\db;

use app\base\Object;

class Statement extends Object
{
    protected $statements = [];

    public function add(SelectFromWhere $statement)
    {
        $this->statements[] = $statement;
    }
}