<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 12.05.2016
 * Time: 10:25
 */

declare(strict_types=1);

namespace app\db\builder;


abstract class Operator extends Query implements
    IOperator,
    IWhere
{
    private $operator = [];

    public function getOperator() : array
    {
        return $this->operator;
    }

    public function setOperator(IOperator $or)
    {
        $this->operator[] = $or;
    }

    public function add($operator)
    {
        $this->setOperator($operator);
    }

    public function parser($statement)
    {
        $this->parserArray($statement);
    }

    protected function parserArray(array $statement)
    {
        foreach ($statement as $key => $value) {
            if (is_int($key) && is_string($value)) {
                $string = new SqlString();
                $this->add($string);
                $string->add($value);
            }
            if (is_array($value)) {
                $class = __NAMESPACE__ . '\\Where' . ucfirst($value[0]);
                array_shift($value);
                $obj = new $class();
                $this->add($obj);
                $obj->parser($value);
            }
        }
    }
}