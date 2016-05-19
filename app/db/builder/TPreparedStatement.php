<?php

namespace app\db\builder;


trait TPreparedStatement
{
    protected $parameter = null;

    public function setParameter(PreparedStatement $parameter)
    {
        $this->parameter = $parameter;
    }

    public function getParameter()
    {
        return $this->parameter;
    }
}