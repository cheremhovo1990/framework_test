<?php

namespace app;

class BuildQuery
{
    public $build = [];

    public function select($select)
    {
        $this->build['select'] = [];
        if (is_string($select)) {
            array_push($this->build['select'], $select);
        }
        if (is_array($select)) {
            foreach ($select as $key => $elem) {
                if (is_int($key)) {
                    array_push($this->build['select'], $elem);
                }
                if (is_string($key)) {
                    array_push($this->build['select'], $key . ' AS ' . $elem);
                }
            }
        }

    }

    public function from($from)
    {
        $this->build['from'] = [];
        array_push($this->build['from'], $from);
    }

    public function where($conditions)
    {
        $this->build['where'] = [];
        if (in_array('and', $conditions)) {

            $this->build['where']['and'] = [];
            array_push($this->build['where']['and'], $conditions[1]);
            array_push($this->build['where']['and'], $conditions[2]);
        }
        if (in_array('or', $conditions)) {

            $this->build['where']['or'] = [];

            foreach ($conditions as $key => $item) {
                if ($key === 0) {
                    continue;
                }
                array_push($this->build['where']['or'], $item);
            }
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
            $statament .= implode($this->build['from']);
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
        }
        return $statament;
    }
}
