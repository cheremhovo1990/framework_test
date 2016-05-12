<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 10.05.2016
 * Time: 10:37
 */

declare(strict_types=1);

namespace app\db\builder;


class Where
{
    private $wheres = [];

    public function setWheres($where)
    {
        $this->wheres[] = $where;
    }

    public function getWheres() : array
    {
        return $this->wheres;
    }

    public function add($where)
    {
        $this->setWheres($where);
    }

    public function parser($statement)
    {
        if (is_string($statement)) {
            $and = new WhereAnd();
            $this->add($and);
            $string = new WhereString();
            $string->add($statement);
            $and->add($string);
        }
        if (is_array($statement)) {
            if ($statement[0] === 'or') {
                array_shift($statement);
                $or = new WhereOr();
                $this->add($or);
                $or->parser($statement);
            } else {
                if ($statement[0] === 'and') {
                    array_shift($statement);
                }
                $and = new WhereAnd();
                $this->add($and);
                $and->parser($statement);
            }
        }
    }
}