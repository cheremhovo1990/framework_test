<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 10.05.2016
 * Time: 10:37
 */

declare(strict_types=1);

namespace app\db\builder;


class Where  implements IStatement
{
    private $wheres;

    public function setWheres(IWhere $where)
    {
        $this->wheres = $where;
    }

    public function getWheres() : IWhere
    {
        return $this->wheres;
    }

    public function add(IWhere $where)
    {
        $this->setWheres($where);
    }

    public function parser($statement)
    {
        if (is_string($statement)) {
            $and = new WhereAnd();
            $this->add($and);
            $string = new SqlString();
            $string->add($statement);
            $and->add($string);
            return ;
        }

        $class = __NAMESPACE__ . '\\Where' . ucfirst($statement[0]);

        if (!class_exists($class)) {
            $obj = new WhereAnd();
        } else {
            $obj = new $class();
            array_shift($statement);
        }
        $this->add($obj);
        $obj->parser($statement);
    }
}