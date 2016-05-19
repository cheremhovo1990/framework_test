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
    use TPreparedStatement;

    private $operator = [];

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
        $parameter = $this->getParameter();

        foreach ($statement as $key => $value) {
            if (is_int($key) && is_string($value)) {
                $string = new WhereString($value);
                $parameter->addWhereString($string);
                if (!is_null($this->getParameter())) {
                    $string->filter($parameter);
                }
                $this->add($string);
            }
            if (is_string($key) && (is_string($value) || is_int($value))) {
                $str = $parameter->convert($key, $value);
                $string = new WhereString($str);
                $this->add($string);
            }
            if (is_array($value)) {
                $class = __NAMESPACE__ . '\\Where' . ucfirst($value[0]);
                array_shift($value);
                $obj = new $class();

                $obj->setParameter($parameter);

                $this->add($obj);
                $obj->parser($value);
            }
        }
    }
}