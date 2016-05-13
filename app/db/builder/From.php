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

    private $froms = [];

    public function setFroms(SqlString $from)
    {
        $this->froms[] = $from;
    }

    public function getFroms() : array
    {
        return $this->froms;
    }

    public function add(SqlString $from)
    {
        $this->setFroms($from);
    }
}