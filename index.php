<?php

require(__DIR__ . '/vendor/autoload.php');

$built1 = new \app\BuildQuery();
$built1->select('name');
$except1 = 'SELECT name';
echo $built1->statament();