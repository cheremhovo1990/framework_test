<?php

require(__DIR__ . '/vendor/autoload.php');

class Test extends app\BaseBuilder
{

}

$obj = new Test;

echo $obj->shielding(' name   as  dasd') . PHP_EOL;
echo $obj->shielding(' name   .  id  ') . PHP_EOL;