<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 12.05.2016
 * Time: 8:26
 */

declare(strict_types=1);

namespace app\db\builder;


class WhereAnd implements
    IWhere,
    IOperator
{
    use Operator;

    private $ands = [];

    public function getAnds() : array
    {
        return $this->ands;
    }

    public function setAnds(IOperator $and)
    {
        $this->ands[] = $and;
    }

    public function add(IOperator $and)
    {
        $this->setAnds($and);
    }
}