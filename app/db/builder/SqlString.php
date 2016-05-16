<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 08.05.2016
 * Time: 8:05
 */

declare(strict_types=1);

namespace app\db\builder;


class SqlString extends Query implements IOperator
{
    private $string;

    public function __construct(string $str)
    {
        $this->setString($str);
    }

    public function getString() : string
    {
        return $this->string;
    }

    public function setString(string $str)
    {
        $this->string = $str;
    }
}