<?php

namespace fra\db;

abstract class Model
{

    const TABLE = '';

    public $id;

    // protected $statement;

    public function getStatement() : BuilderQuery
    {
        return $this->statement;
    }

    public function setStatement(BuilderQuery $statement)
    {
        $this->statement = $statement;
    }



    public static function findAll()
    {
        $db = new Db();
        $statement = new BuilderQuery();
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
        $statement = new BuilderQuery();
        $sql = $statement->select('*')->from(static::TABLE)->where('id=:id', [':id' => $id])->getSql();
        return $db->query($sql,
            $statement->getParam(),
            static::class
        )[0];
    }

    public static function find()
    {
        $model = new static();
        $model->setStatement(new BuilderQuery());
        return $model;
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

        $db = new Db();
        $statement = new BuilderQuery();

        $insert = [static::TABLE];
        foreach ($this as $k => $v) {
            if ('id' == $k) {
                continue;
            }
            $insert[$k] = $v;
        }
        $statement->insert($insert);
        $sql = $statement->getSql();
        $db->execute($sql, $statement->getParam());
        $this->id = $db->lastInsertId();
    }

}