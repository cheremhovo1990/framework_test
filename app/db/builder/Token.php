<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 10.05.2016
 * Time: 8:34
 */

declare(strict_types=1);

namespace app\db\builder;


abstract class Token extends Query implements IStatement
{
    use TShield;

    protected $tokens = [];

    public function add($select)
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

    public function arrangeStatement($statement)
    {
        if (is_string($statement)) {
            $statement = $this->performShield($statement);
            $string = new SqlString($statement);
            $this->add($string);
        } elseif(is_array($statement)) {
            foreach ($statement as $key => $elem) {
                if (is_string($key) && is_string($elem)) {
                    $shieldString = $this->performShield($elem . ' AS ' . $key);
                    $string = new SqlString($shieldString);
                    $this->add($string);
                }
                if (is_int($key) && is_string($elem)) {
                    $elem = $this->performShield($elem);
                    $string = new SqlString($elem);
                    $this->add($string);
                }
            }
        } else {
            throw new \Exception('Argument');
        }
    }

    protected function performShield($string)
    {
        return $this->shield->run($string);
    }
}