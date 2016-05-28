<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 24.04.2016
 * Time: 8:29
 */

declare(strict_types=1);

namespace fra\db;

use fra\db\builder\Statement;

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
        if (!$sql->issetPreparedStatement()) {
            $parameter =  new builder\PreparedStatement();
            $sql->setPreparedStatement($parameter);
        }
        $shield = new builder\Shield();
        if (!is_null($parameters)) {
            $sql->getPreparedStatement()->setPreparedStatements($parameters);
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