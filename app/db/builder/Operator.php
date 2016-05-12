<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 12.05.2016
 * Time: 10:25
 */

declare(strict_types=1);

namespace app\db\builder;


abstract class Operator
{
    public function parser(array $statement)
    {
        foreach ($statement as $key => $value) {
            if (is_int($key) && is_string($value)) {
                $string = new WhereString();
                $this->add($string);
                $string->add($value);
            }
            if (is_array($value)) {
                if ($value[0] === 'or') {
                    array_shift($value);
                    $or = new WhereOr();
                    $this->add($or);
                    $or->parser($value);
                }
                if ($value[0] === 'and') {
                    array_shift($value);
                    $or = new WhereAnd();
                    $this->add($or);
                    $or->parser($value);
                }
            }
        }
    }
}