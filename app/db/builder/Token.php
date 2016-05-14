<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 10.05.2016
 * Time: 8:34
 */

declare(strict_types=1);

namespace app\db\builder;


abstract class Token implements IStatement
{
    protected $tokens = [];

    public function add(SqlString $select)
    {
        $this->setTokens($select);
    }

    public function getTokens() : array
    {
        return $this->tokens;
    }

    public function setTokens(SqlString $select)
    {
        $this->tokens[] = $select;
    }

    public function parser($statement)
    {
        if (is_string($statement)) {
            $string = new SqlString();
            $string->add($statement);
            $this->add($string);
        } elseif(is_array($statement)) {
            foreach ($statement as $key => $elem) {
                if (is_string($key) && is_string($elem)) {
                    $string = new SqlString();
                    $string->add($elem . ' AS ' . $key);
                    $this->add($string);
                }
                if (is_int($key) && is_string($elem)) {
                    $string = new SqlString();
                    $string->add($elem);
                    $this->add($string);
                }
            }
        } else {
            throw new \Exception('Argument');
        }
    }
}