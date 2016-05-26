<?php

namespace fra\db;

abstract class Model
{

    const TABLE = '';

    public $id;

    protected $statement;
    protected $db;

    public function getDb() : Db
    {
        return $this->db;
    }

    public function setDb(Db $db)
    {
        $this->db = $db;
    }



    public  function extractPublicProperty($object) : array
    {
        $reflectionObject = new \ReflectionObject($object);
        $properties = array_map(function ($a){
            return $a->getName();
        },$reflectionObject->getProperties(\ReflectionProperty::IS_PUBLIC));
        return $properties;
    }

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

    public function select($select)
    {
        $statement = $this->getStatement();
        $statement->select($select);
        return $this;
    }

    public function from($from)
    {
        $statement = $this->getStatement();
        $statement->from($from);
        return $this;
    }

    public function where($where, $param = null)
    {
        $statement = $this->getStatement();
        $statement->where($where, $param);
        return $this;
    }

    public function getSql() : string
    {
        $statement = $this->getStatement();
        return $statement->getSql();
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
        $property = $this->extractPublicProperty($this);
        foreach ($property as $value) {
            if ('id' == $value) {
                continue;
            }
            $insert[$value] = $this->$value;
        }
        $statement->insert($insert);
        $sql = $statement->getSql();
        $db->execute($sql, $statement->getParam());
        $this->id = $db->lastInsertId();
    }
}