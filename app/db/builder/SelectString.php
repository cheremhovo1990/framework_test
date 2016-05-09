<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 08.05.2016
 * Time: 8:05
 */

namespace app\db\builder;


class SelectString
{
    public $string;

    public function add(string $str)
    {
        $this->setString($str);
    }

    public function getString()
    {
        return $this->string;
    }

    public function setString($str)
    {
        $this->string = $str;
    }
}