<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 09.05.2016
 * Time: 10:11
 */

declare(strict_types=1);

namespace app\db\builder;


class From implements IStatement
{
    use Token;

    private $from = [];

    public function setFrom(SqlString $from)
    {
        $this->from[] = $from;
    }

    public function getFrom() : array
    {
        return $this->from;
    }

    public function add(SqlString $from)
    {
        $this->setFrom($from);
    }
}