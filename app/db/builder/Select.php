<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 08.05.2016
 * Time: 8:03
 */

declare(strict_types=1);

namespace app\db\builder;

class Select
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

    public function parser($statement)
    {
        if (is_string($statement)) {
            $string = new SelectString();
            $string->add($statement);
            $this->add($string);
        } elseif(is_array($statement)) {
            foreach ($statement as $key => $elem) {
                if (is_string($key) && is_string($elem)) {
                    $string = new SelectString();
                    $string->add($elem . ' AS ' . $key);
                    $this->add($string);
                }
                if (is_int($key) && is_string($elem)) {
                    $string = new SelectString();
                    $string->add($elem);
                    $this->add($string);
                }
            }
        } else {
            throw new \Exception('Argument');
        }
    }
}