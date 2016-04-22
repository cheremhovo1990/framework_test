<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 22.04.2016
 * Time: 10:04
 */

namespace app;


class Db
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO('sqlite:' . __DIR__ . '/../data/db.db');
    }

    public function execute($sql, $param)
    {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($param);
    }

    public function query($sql, $param)
    {
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute($param);
    }
}