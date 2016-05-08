<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 07.05.2016
 * Time: 10:17
 */

namespace app\db;

use app\base\Object;

abstract class Builder extends Object
{
    abstract public function add(SelectFromWhere $statement);
}