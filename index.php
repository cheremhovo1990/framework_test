<?php

require(__DIR__ . '/vendor/autoload.php');

$db = new \app\Db();
$sql = 'SELECT * FROM Test';

$res = $db->query($sql, [], \app\Test::class);

var_dump($res);
