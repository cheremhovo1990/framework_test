<?php

declare(strict_types = 1);

namespace fra\db\builder;

class Insert extends Query implements IStatement
{
    use TPreparedStatement,
        TShield;

    public $table;

    public $insert = [];

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
            $identify = $parameter->identify();
            $insert = [$key => $identify];
            $parameter->setPreparedParameters([$identify => $elem]);
            $this->add($insert);
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

    public function setInsert(array $insert)
    {
        $this->insert = $this->insert + $insert;
    }

    public function buildStatement() : string
    {
        $result = 'INSERT INTO ' . $this->getTable();
        $column = '(';
        $value = '(';
        $column .= implode(', ',array_keys($this->getInsert()));
        $value .= implode(', ',array_values($this->getInsert()));
        $column .= ')';
        $value .= ')';
        $result .= $column . 'VALUES' . $value;
        return $result;
    }
}