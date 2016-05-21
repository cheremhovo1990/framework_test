<?php

declare(strict_types=1);

namespace app\db;

class BuilderQuery extends BaseBuilder
{
    public function select($select)
    {
        $this->arrangeStatement('select', $select);
    }
    public function from($from)
    {
        $this->arrangeStatement('from', $from);
    }

    public function where($where, $parameters = null)
    {
        $this->arrangeStatement('where', $where, $parameters);
    }
}
