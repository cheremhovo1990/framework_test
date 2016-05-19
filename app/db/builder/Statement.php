<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 08.05.2016
 * Time: 8:01
 */

declare(strict_types=1);

namespace app\db\builder;

class Statement extends Query
{
    use TPreparedStatement;

    private $statements;
    protected $class;

    public function __construct(string $token)
    {
        $this->setClass($token);
    }

    public function setClass($token)
    {
        $this->class = __NAMESPACE__ . '\\' . ucfirst($token);
    }

    public function parser($statement)
    {
        $class = $this->getClass();
        $sqlObject = new $class();
        $this->add($sqlObject);
        if ($sqlObject instanceof Where ) {
            $sqlObject->setParameter($this->getParameter());
        }
        $sqlObject->parser($statement);
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
}