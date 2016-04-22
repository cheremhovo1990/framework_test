<?php

namespace app;

class BuildQuery
{
    public $build = [];

    public function select($select)
    {
        $arr = [];
        $this->build['select'] = [];
        array_push($this->build['select'], $select);
    }

    public function from($from)
    {
        $arr = [];
        $this->build['from'] = [];
        array_push($this->build['from'], $from);
    }

    public function statament()
    {
        $statament = '';
        if (!empty($this->build['select'])) {
            $statament .= 'SELECT ';
            $statament .= implode($this->build['select']);
        }

        if (!empty($this->build['from'])) {
            $statament .= ' FROM ';
            $statament .= implode($this->build['from']);
        }

        return $statament;
    }
}
