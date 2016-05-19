<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 10.05.2016
 * Time: 10:37
 */

declare(strict_types=1);

namespace app\db\builder;


class Where extends Query implements IStatement
{
    use TPreparedStatement;

    private $where;

    public function add($where)
    {
        $this->setWhere($where);
    }

    public function setWhere(IWhere $where)
    {
        $this->where = $where;
    }

    public function getWhere() : IWhere
    {
        return $this->where;
    }

    public function parser($statement)
    {
        if (is_string($statement)) {
            $statement = ['and', $statement];
        }

        $class = __NAMESPACE__ . '\\Where' . ucfirst($statement[0]);

        if (!class_exists($class)) {
            $obj = new WhereAnd();
        } else {
            $obj = new $class();
            array_shift($statement);
        }

        $obj->setPreparedStatement($this->getPreparedStatement());


        $this->add($obj);
        $obj->parser($statement);
    }
}