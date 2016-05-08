<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 07.05.2016
 * Time: 10:33
 */

namespace app\db;


class BuilderQuery extends BaseBuilder
{
    public function select($select)
    {
        $this->createStatement('select', $select);
    }
}