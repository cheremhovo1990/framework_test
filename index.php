<?php

require(__DIR__ . '/vendor/autoload.php');

$db = new \app\Db();
$sql = 'INSERT INTO Test(name) VALUES (:SECOND)';
$res = $db->execute($sql, [':SECOND' => 'SECOND']);

var_dump($sql);
