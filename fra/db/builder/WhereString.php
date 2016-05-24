<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 17.05.2016
 * Time: 10:11
 */

declare(strict_types=1);

namespace fra\db\builder;


class WhereString extends SqlString
{
    use TPreparedStatement;

    public function preformBindParam()
    {
        $str = $this->getString();
        $str = $this->getPreparedStatement()->bindParam($str);
        $this->setString($str);
    }
}