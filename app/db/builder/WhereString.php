<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 12.05.2016
 * Time: 8:36
 */

declare(strict_types=1);

namespace app\db\builder;


class WhereString
{
    private $string;

    public function add(string $str)
    {
        $this->setString($str);
    }

    public function getString()
    {
        return $this->string;
    }

    public function setString(string $str)
    {
        $this->string = $str;
    }
}