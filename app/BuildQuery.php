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

        $statament .= $this->buildWhere();

        return $statament;
    }
}
