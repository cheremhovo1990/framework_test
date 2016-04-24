<?php

require(__DIR__ . '/vendor/autoload.php');

$built = new \app\BuildQuery();
$built->select(['first', 'second']);


echo $built->statament();