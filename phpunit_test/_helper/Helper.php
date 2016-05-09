<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 09.05.2016
 * Time: 9:20
 */

namespace unit\_helper;


class Helper extends \PHPUnit_Framework_TestCase
{

    protected function getFuntion()
    {
        return function($name)
        {
            return $this->$name;
        };
    }

    protected function getfield($obj, $field)
    {
        $function = $this->getFuntion();
        return $function->bindTo($obj, get_class($obj))($field);
    }

    protected function callMethod($object, string $method, array $arguments)
    {
        $method = new \ReflectionMethod($object, $method);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $arguments);
    }
}