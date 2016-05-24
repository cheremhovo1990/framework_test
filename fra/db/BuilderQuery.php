<?php

declare(strict_types=1);

namespace fra\db;

class BuilderQuery extends BaseBuilder
{
    public function select($select) : BuilderQuery
    {
        $this->arrangeStatement('select', $select);
        return $this;
    }
    public function from($from) : BuilderQuery
    {
        $this->arrangeStatement('from', $from);
        return $this;
    }

    public function where($where, $parameters = null) : BuilderQuery
    {
        $this->arrangeStatement('where', $where, $parameters);
        return $this;
    }

    public function getSql() : string
    {
        return $this->buildStatement();
    }

    public function getParam() : array
    {
        return $this->getPreparedParameters();
    }
}
