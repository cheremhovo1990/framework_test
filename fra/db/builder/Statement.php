<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 08.05.2016
 * Time: 8:01
 */

declare(strict_types=1);

namespace fra\db\builder;

class Statement extends Query
{
    use TPreparedStatement,
        TShield;

    private $statements;
    private $class;

    public function setClass($token)
    {
        $this->class = __NAMESPACE__ . '\\' . ucfirst($token);
    }

    public function arrangeStatement($statement)
    {
        $class = $this->getClass();
        $sqlObject = new $class();
        $this->add($sqlObject);
        if ($sqlObject instanceof Where || $sqlObject instanceof Insert ) {
            $sqlObject->setPreparedStatement($this->getPreparedStatement());
        }
        $sqlObject->setShield($this->getShield());
        $sqlObject->arrangeStatement($statement);
    }

    public function getClass()
    {
        return $this->class;
    }

    public function add($statement)
    {
        $this->setStatements($statement);
    }

    public function setStatements(IStatement $statement)
    {
        $this->statements[] = $statement;
    }

    public function getStatements() : array
    {
        return $this->statements;
    }

    public function buildStatement() : string
    {
        $result = '';
        foreach ($this->statements as $statement) {
            $result .= $statement->buildStatement();
        }
        return $result;
    }
}