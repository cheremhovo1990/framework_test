<?php

require(__DIR__ . '/vendor/autoload.php');

$built = new \app\BuildQuery();
$built->select('name');
$built->from('Test');


echo $built->statament();