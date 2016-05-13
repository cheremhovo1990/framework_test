<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 08.05.2016
 * Time: 8:05
 */

declare(strict_types=1);

namespace app\db\builder;


class SqlString implements IOperator
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