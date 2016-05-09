<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 08.05.2016
 * Time: 8:01
 */

declare(strict_types=1);

namespace app\db\builder;

class Statement
{
    private $statements = [];

    public function add($statement)
    {
        $this->setStatements($statement);
    }

    public function getStatements() : array
    {
        return $this->statements;
    }

    public function setStatements($statement)
    {
        $this->statements[] = $statement;
    }

    public function parser(string $token, $statement)
    {
        if ($token === 'select') {
            $select = new Select();
        }
        $this->add($select);
        $select->parser($statement);
    }
}