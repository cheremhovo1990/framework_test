<?php

declare(strict_types=1);

namespace app\db;

class BuilderQuery extends BaseBuilder
{
    public function select($select)
    {
        $this->parser('select', $select);
    }
}
