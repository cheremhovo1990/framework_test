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
    public $statement;

    public function getStatement() : Statement
    {
        return $this->statement;
    }

    public function setStatement(Statement $statement)
    {
        $this->statement = $statement;
    }
    
    protected function parser(string $token, $statement)
    {
        $sql = new Statement($token);
        $this->setStatement($sql);
        $sql->parser($statement);
    }
}