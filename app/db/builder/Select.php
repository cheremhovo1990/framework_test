<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 08.05.2016
 * Time: 8:03
 */

declare(strict_types=1);

namespace app\db\builder;

class Select extends Token
{
    private $selects = [];

    public function add($select)
    {
        $this->setSelects($select);
    }

    public function getSelects() : array
    {
        return $this->selects;
    }

    public function setSelects($select)
    {
        $this->selects[] = $select;
    }
}