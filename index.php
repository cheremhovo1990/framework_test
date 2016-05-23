<?php

error_reporting(-1);

require(__DIR__ . '/vendor/autoload.php');

$builder = new app\db\BuilderQuery();
$builder->select('select_1');
$builder->from('from_1');
echo $builder->getSql();
