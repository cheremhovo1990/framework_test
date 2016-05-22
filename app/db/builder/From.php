<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 09.05.2016
 * Time: 10:11
 */

declare(strict_types=1);

namespace app\db\builder;


class From extends Token
{
    protected function getNameToken() : string
    {
        return 'FROM';
    }
}