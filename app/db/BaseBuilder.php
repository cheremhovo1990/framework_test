<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 07.05.2016
 * Time: 10:33
 */

namespace app\db;

use app\base\Object;

abstract class BaseBuilder extends Object
{
    protected $statement = null;

    protected function createStatement($token, $statement)
    {
        $this->statement = new Statement();
        if ($token === 'select') {
            $selectFromWhere = new StatementSelect();
        }
        $this->statement->add($selectFromWhere);
        if (is_string($statement)) {
            $selectString= new SelectString();
            $selectString->string = $statement;
            $selectFromWhere->add(selectString);
        }
    }
}