<?php

error_reporting(-1);

require(__DIR__ . '/vendor/autoload.php');

(new app\db\BuilderQuery())->where('str=:param1', [':param1' => 'hello']);
