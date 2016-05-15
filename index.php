<?php

error_reporting(-1);

require(__DIR__ . '/vendor/autoload.php');

$obj = (new app\db\Builderquery())->where(['str=param1']);
