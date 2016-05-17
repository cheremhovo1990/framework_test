<?php

declare(strict_types=1);

namespace app\db;

class BuilderQuery extends BaseBuilder
{
    public function select($select)
    {
        $this->parser('select', $select);
    }
    public function from($from)
    {
        $this->parser('from', $from);
    }

    public function where($where, $parameters = null)
    {
        $this->parser('where', $where, $parameters);
    }
}
