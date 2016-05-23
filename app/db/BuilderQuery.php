<?php

declare(strict_types=1);

namespace app\db;

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
}
