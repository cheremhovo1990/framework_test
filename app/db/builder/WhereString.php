<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 17.05.2016
 * Time: 10:11
 */

declare(strict_types=1);

namespace app\db\builder;


class WhereString extends SqlString
{

    public function filter(PreparedStatement $parameter)
    {
        $str = $this->getString();
        $str = $parameter->filter($str);
        $this->setString($str);
    }
}