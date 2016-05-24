<?php

declare(strict_types = 1);

namespace fra\db\builder;

class Insert extends Query
{
    use TPreparedStatement;

    public $table;

    public $insert;

    public function getTable() : string
    {
        return $this->table;
    }

    public function setTable(string $table)
    {
        $this->table = $table;
    }

    public function arrangeStatement($statement)
    {
        $table = array_shift($statement);
        $this->setTable($table);
        foreach ($statement as $key => $elem) {
            $parameter = $this->getPreparedStatement();
            $str = $parameter->bindValue($key, $elem);
            $this->add($str);
        }
    }

    public function add($str)
    {
        $this->setInsert($str);
    }

    public function getInsert() : array
    {
        return $this->insert;
    }

    public function setInsert(string $insert)
    {
        $this->insert[] = $insert;
    }

    public function buildStatement() : string
    {
        $result = 'INSERT INTO ' . $this->getTable() . ' SET ';
        foreach ($this->getInsert() as $key => $item) {
            if ($key !== 0) {
                $result .= ', ';
            }
            $result .= $item;
        }
        return $result;
    }
}