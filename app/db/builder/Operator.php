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
    private $parameter = null;

    public function add($operator)
    {
        $this->setOperator($operator);
    }

    public function setOperator(IOperator $operator)
    {
        $this->operator[] = $operator;
    }

    public function getOperator() : array
    {
        return $this->operator;
    }

    public function parser($statement)
    {
        $this->parserArray($statement);
    }

    protected function parserArray(array $statement)
    {
        foreach ($statement as $key => $value) {
            if (is_int($key) && is_string($value)) {
                $string = new WhereString($value);
                if (!is_null($this->getParameter())) {
                    $string->filter($this->getParameter());
                }
                $this->add($string);
            }
            if (is_array($value)) {
                $class = __NAMESPACE__ . '\\Where' . ucfirst($value[0]);
                array_shift($value);
                $obj = new $class();
                if (!is_null($this->getParameter())) {
                    $obj->setParameter($this->getParameter());
                }
                $this->add($obj);
                $obj->parser($value);
            }
        }
    }

    public function setParameter(Parameter $parameter)
    {
        $this->parameter = $parameter;
    }

    public function getParameter()
    {
        return $this->parameter;
    }

}