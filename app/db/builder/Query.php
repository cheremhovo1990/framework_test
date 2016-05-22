<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 16.05.2016
 * Time: 15:08
 */

declare(strict_types=1);

namespace app\db\builder;

abstract class Query
{
    public function add($statement)
    {
        throw \Exception();
    }
    
    public function arrangeStatement($statement)
    {
        throw \Exception();
    }

    public function buildStatement() : string
    {
        throw \Exception();
    }
}