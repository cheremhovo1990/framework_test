<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 24.04.2016
 * Time: 8:29
 */

declare(strict_types=1);

namespace app\db;

use app\db\builder\Statement;

abstract class BaseBuilder
{
    private $statement;

    public function getStatement() : Statement
    {
        return $this->statement;
    }

    public function setStatement(Statement $statement)
    {
        $this->statement = $statement;
    }

    public function issetStatement()
    {
        return isset($this->statement);
    }

    protected function arrangeStatement(string $token, $statement,array $parameters = null)
    {
        if (!$this->issetStatement()) {
            $this->setStatement(new Statement());
        }
        $sql = $this->getStatement();
        $sql->setClass($token);
        $parameter =  new builder\PreparedStatement();
        $shield = new builder\Shield();
        $sql->setPreparedStatement($parameter);
        if (!is_null($parameters)) {
            $parameter->setPreparedStatements($parameters);
        }
        $sql->setShield($shield);
        $sql->arrangeStatement($statement);
    }

    protected function buildStatement() : string
    {
        return $this->getStatement()->buildStatement();
    }

    protected function getPreparedParameters() : array
    {
        return $this->getStatement()->getPreparedStatement()->getPreparedParameters();
    }
}