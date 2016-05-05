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

    protected function parser($token, $statement)
    {
        $this->createOperatorIntoArray($this->build, $token);
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

    protected function createOperatorIntoArray(array &$operators, $token)
    {
        if (empty($operators[$token])) {
            $operators[$token] = [];
        }
    }

    protected function buildArray(array &$array, $statement)
    {
        if (in_array('or', $statement)) {
            $this->createOperator($array, 'or', $statement);
            return ;
        }
        if (!in_array('and', $statement)) {
            array_unshift($statement, 'and');
        }
        $this->createOperator($array, 'and', $statement);
    }

    protected function createOperator(&$array ,$oper , $statement)
    {
        $this->createOperatorIntoArray($array, $oper);
        foreach ($statement as $key => $elem) {
            if ($key === 0) {
                continue;
            }
            $this->createOperandIntString($array, $oper, $key, $elem);
            $this->createOperandStringStringOrFloatOrInt($array, $oper, $key, $elem);
            $this->createOperandIntArray($array, $oper, $key, $elem);
            $this->createStringArray($array, $oper, $key, $elem);
        }
    }

    protected function createOperandIntString(&$array, $oper ,$key, $elem)
    {
        if (is_int($key) && is_string($elem)) {
            array_push($array[$oper], $elem);
        }
    }

    protected function createOperandStringStringOrFloatOrInt(&$array, $oper ,$key, $elem)
    {
        if (is_string($key) && (is_string($elem) || is_float($elem) || is_int($elem))) {
            array_push($array[$oper], $key. '=' . $elem);
        }
    }

    protected function createOperandIntArray(&$array, $oper ,$key, $elem)
    {
        if (is_int($key) && is_array($elem) ) {
            var_dump($elem);
            $this->buildArray($array[$oper], $elem);
        }
    }

    protected function createStringArray(&$array, $oper ,$key, $elem)
    {
        if (is_string($key) && is_array($elem)) {
            $this->createOperatorIntoArray($array[$oper], 'in');
            array_push($array[$oper]['in'], $key);
            array_push($array[$oper]['in'], $elem);
        }
    }

    protected function buildWhere()
    {
        $statament = '';
        if (!empty($this->build['where'])) {
            $statament .= ' WHERE ';
            if (is_string($this->build['where'])) {
                $statament .= $this->build['where'];
            }
            if (!empty($this->build['where']['and']) || !empty($this->build['where']['or'])) {
                $statament .= $this->buildAndOr($this->build['where']);
            }
        }
        return $statament;
    }

    protected function buildAndOr(array $arr)
    {
        $statament = '(';
        if (!empty($arr['and'])) {
            $count = 0;
            foreach ($arr['and'] as $key => $elem) {
                $count += 1;
                if ($count > 1) {
                    $statament .= ' AND ';
                }
                if (is_int($key) && is_string($elem)) {
                    $statament .= $elem;
                }
                if ($key === 'and' && is_array($elem)) {
                    $statament .= $this->buildAndOr($arr['and']);
                }
            }
        }
        if (!empty($arr['or'])) {
            $count = 0;
            foreach ($arr['or'] as $key => $elem) {
                $count += 1;
                if ($count > 1) {
                    $statament .= ' OR ';
                }
                if (is_int($key) && is_string($elem)) {
                    $statament .= $elem;
                }
                if ($key === 'or' && is_array($elem)) {
                    $statament .= $this->buildAndOr($arr['or']);
                }
            }
        }
        $statament .= ')';
        return $statament;
    }
}