<?php

namespace fra;

abstract class Model
{

    const TABLE = '';

    public $id;

    public static function findAll()
    {
        $db = new Db();
        $statement = new db\BuilderQuery();
        $sql = $statement->select('*')->from(static::TABLE)->getSql();
        return $db->query(
            $sql,
            [],
            static::class
        );
    }

    public static function findById($id)
    {
        $db = new Db();
        $statement = new db\BuilderQuery();
        $sql = $statement->select('*')->from(static::TABLE)->where('id=:id', [':id' => $id])->getSql();
        return $db->query($sql,
            $statement->getParam(),
            static::class
        )[0];
    }

    public function isNew()
    {
        return empty($this->id);
    }

    public function insert()
    {
        if (!$this->isNew()) {
            return;
        }

        $columns = [];
        $values = [];
        foreach ($this as $k => $v) {
            if ('id' == $k) {
                continue;
            }
            $columns[] = $k;
            $values[':'.$k] = $v;
        }

        $sql = '
INSERT INTO ' . static::TABLE . '
(' . implode(',', $columns) . ')
VALUES
(' . implode(',', array_keys($values)) . ')
        ';
        $db = Db::instance();
        $db->execute($sql, $values);
    }

}