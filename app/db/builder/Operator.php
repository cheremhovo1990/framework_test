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
    use TPreparedStatement,
        TShield;

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

    public function arrangeStatement($statement)
    {
        $this->arrangeStatementArray($statement);
    }

    protected function arrangeStatementArray(array $statement)
    {
        $parameter = $this->getPreparedStatement();

        foreach ($statement as $key => $value) {
            if (is_int($key) && is_string($value)) {
                $string = new WhereString($value);
                $parameter->addWhereString($string);
                $string->setPreparedStatement($this->getPreparedStatement());
                $string->preformBindParam();
                $this->add($string);
            }
            if (is_string($key) && (is_string($value) || is_int($value))) {
                $str = $parameter->bindValue($key, $value);
                $string = new WhereString($str);
                $this->add($string);
            }
            if (is_array($value)) {
                $class = __NAMESPACE__ . '\\Where' . ucfirst($value[0]);
                array_shift($value);
                $obj = new $class();

                $obj->setPreparedStatement($parameter);

                $this->add($obj);
                $obj->arrangeStatement($value);
            }
        }
    }
}