<?php

error_reporting(-1);

require(__DIR__ . '/vendor/autoload.php');

require(__DIR__ . '/models/Test.php');

$test = new Test();

var_dump($test->findById(8));
