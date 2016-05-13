<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 12.05.2016
 * Time: 8:49
 */

namespace app\db\builder;


class WhereOr implements
    IWhere,
    IOperator
{
    use Operator;

    private $ors = [];

    public function getOrs() : array
    {
        return $this->ors;
    }

    public function setOrs($or)
    {
        $this->ors[] = $or;
    }

    public function add($or)
    {
        $this->setOrs($or);
    }
}