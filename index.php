<?php

require(__DIR__ . '/vendor/autoload.php');

$builder = new app\db\BuilderQuery();
$builder->select('string');

var_dump($builder);