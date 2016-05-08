<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 07.05.2016
 * Time: 11:11
 */

namespace app\db;

use app\base\Object;

class SelectString extends Object
{
    private $string = null;

    public function setString($str)
    {
        $this->string = $str;
    }

    public function getString()
    {
        return $this->string;
    }
}