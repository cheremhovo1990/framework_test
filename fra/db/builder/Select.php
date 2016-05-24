<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 08.05.2016
 * Time: 8:03
 */

declare(strict_types=1);

namespace fra\db\builder;

class Select extends Token
{
    protected function getNameToken() : string
    {
        return 'SELECT';
    }
}