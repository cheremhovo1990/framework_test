<?php

namespace app;


class BuildQuery extends BaseBuilder
{

    private $params = [];

    public function select($select)
    {
        $this->parser('select', $select);
    }

    public function from($from)
    {
        $this->parser('from', $from);
    }

    public function where($conditions, $params = null)
    {
        $this->createOperatorIntoArray($this->build, 'where');

        if (is_string($conditions)) {
            $this->build['where'] = $conditions;
            return;
        }

        $this->buildArray($this->build['where'], $conditions);
    }

    private function createOperatorIntoArray(array &$operators, $token)
    {
        if (empty($operators[$token])) {
            $operators[$token] = [];
        }
    }

    private function buildArray(array &$array, $statement)
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

    private function createOperator(&$array ,$oper , $statement)
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

    private function createOperandIntString(&$array, $oper ,$key, $elem)
    {
        if (is_int($key) && is_string($elem)) {
            array_push($array[$oper], $elem);
        }
    }

    private function createOperandStringStringOrFloatOrInt(&$array, $oper ,$key, $elem)
    {
        if (is_string($key) && (is_string($elem) || is_float($elem) || is_int($elem))) {
            array_push($array[$oper], $key. '=' . $elem);
        }
    }

    private function createOperandIntArray(&$array, $oper ,$key, $elem)
    {
        if (is_int($key) && is_array($elem) ) {
            var_dump($elem);
            $this->buildArray($array[$oper], $elem);
        }
    }

    private function createStringArray(&$array, $oper ,$key, $elem)
    {
        if (is_string($key) && is_array($elem)) {
            $this->createOperatorIntoArray($array[$oper], 'in');
            array_push($array[$oper]['in'], $key);
            array_push($array[$oper]['in'], $elem);
        }
    }

    public function statament()
    {
        $statament = '';
        if (!empty($this->build['select'])) {
            $statament .= 'SELECT ';
            $statament .= implode(', ',$this->build['select']);
        }

        if (!empty($this->build['from'])) {
            $statament .= ' FROM ';
            $statament .= implode(', ', $this->build['from']);
        }

        if (!empty($this->build['where'])) {
            $statament .= ' WHERE ';
            if (!empty($this->build['where']['and'])) {
                $statament .= $this->build['where']['and'][0];
                $statament .= ' AND ';
                $statament .= $this->build['where']['and'][1];
            }
            if (!empty($this->build['where']['or'])) {
                $statament .= $this->build['where']['or'][0];
                $statament .= ' OR ';
                $statament .= $this->build['where']['or'][1];
            }
            if (is_string($this->build['where'])) {
                $statament .= $this->build['where'];
            }
        }
        return $statament;
    }
}
