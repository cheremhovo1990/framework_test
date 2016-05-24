<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 16.05.2016
 * Time: 15:08
 */

declare(strict_types=1);

namespace fra\db\builder;

abstract class Query
{
    public function add($statement)
    {
        throw new \Exception();
    }
    
    public function arrangeStatement($statement)
    {
        throw new \Exception();
    }

    public function buildStatement() : string
    {
        throw new \Exception();
    }
}