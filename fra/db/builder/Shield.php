<?php

declare(strict_types = 1);

namespace fra\db\builder;

class Shield
{
    public function run($string)
    {
        $string = trim($string);
        if ($string == '*') {
            return $string;
        }
        if (strpos($string, '(') !== false) {
            return $string;
        }
        $string = '`' . $string;
        $string = str_replace(' as ', ' AS ', $string);
        $result = preg_replace('~(\s*(\.| AS | |, )\s*)~', "`\$2`", $string);
        $result = $result . '`';
        return $result;
    }
}