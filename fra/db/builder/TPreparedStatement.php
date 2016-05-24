<?php

namespace fra\db\builder;


trait TPreparedStatement
{
    private $parameter;

    public function setPreparedStatement(PreparedStatement $parameter)
    {
        $this->parameter = $parameter;
    }

    public function getPreparedStatement() : PreparedStatement
    {
        return $this->parameter;
    }
}