<?php

require(__DIR__ . '/vendor/autoload.php');

$built = new \app\BuildQuery();
$method = new ReflectionMethod($built, 'createOperandIntArray');
$method->setAccessible(true);
$arr = ['or' => []];
$method->invokeArgs($built, [&$arr, 'or', 1, ['str=1']]);
var_dump($arr);
