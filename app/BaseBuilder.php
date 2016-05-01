<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 24.04.2016
 * Time: 8:29
 */

namespace app;


abstract class BaseBuilder
{
    public $build = [];

    public function parser($token, $statement)
    {
        $this->build[$token] = [];
        if (is_string($statement)) {
            array_push($this->build[$token],$statement);
        }
        if (is_array($statement)) {
            foreach ($statement as $key => $elem) {
                if (is_int($key)) {
                    array_push($this->build[$token], $elem);
                }
                if (is_string($key)) {
                    array_push($this->build[$token], $elem  . ' AS ' . $key);
                }
            }
        }
    }
}