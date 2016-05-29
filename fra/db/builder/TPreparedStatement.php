<?php

namespace fra\db\builder;


trait TPreparedStatement
{
    private $preparedStatement;

    public function setPreparedStatement(PreparedStatement $preparedStatement)
    {
        $this->preparedStatement = $preparedStatement;
    }

    public function getPreparedStatement() : PreparedStatement
    {
        return $this->preparedStatement;
    }

    public function issetPreparedStatement()
    {
        return (!empty($this->preparedStatement));
    }
}