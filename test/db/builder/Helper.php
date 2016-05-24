<?php

/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 15.05.2016
 * Time: 9:05
 */

declare(strict_types=1);

namespace unit\db\builder;

class Helper extends \PHPUnit_Framework_TestCase
{
    public static function identify()
    {
        static $number = 0;
        $identify = ':bq' . $number;
        $number++;
        return $identify;
    }
}