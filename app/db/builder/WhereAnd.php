<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 12.05.2016
 * Time: 8:26
 */

declare(strict_types=1);

namespace app\db\builder;


class WhereAnd extends Operator
{
    private $ands = [];

    public function getAnds() : array
    {
        return $this->ands;
    }

    public function setAnds($and)
    {
        $this->ands[] = $and;
    }

    public function add($and)
    {
        $this->setAnds($and);
    }
}