<?php

declare(strict_types = 1);

namespace fra\db\builder;

class Update extends Query implements IStatement
{
    use TPreparedStatement,
        TShield;

    public $table;

    public $update = [];

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
        $this->setUpdate($str);
    }

    public function getUpdate() : array
    {
        return $this->update;
    }

    public function setUpdate(string $update)
    {
        $this->update[] = $update;
    }

    public function buildStatement() : string
    {
        $result = 'UPDATE ' . $this->getTable() . ' SET ';
        foreach ($this->getUpdate() as $key => $item) {
            if ($key !== 0) {
                $result .= ', ';
            }
            $result .= $item;
        }
        return $result;
    }
}