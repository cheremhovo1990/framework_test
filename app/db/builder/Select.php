<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 08.05.2016
 * Time: 8:03
 */

declare(strict_types=1);

namespace app\db\builder;

class Select implements IStatement
{
    use Token;

    private $selects = [];

    public function add(SqlString $select)
    {
        $this->setSelects($select);
    }

    public function getSelects() : array
    {
        return $this->selects;
    }

    public function setSelects(SqlString $select)
    {
        $this->selects[] = $select;
    }
}