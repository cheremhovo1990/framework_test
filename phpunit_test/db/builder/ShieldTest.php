<?php

declare(strict_types = 1);

class ShieldTest extends PHPUnit_Framework_TestCase
{

    public $shield;
    
    public function setUp()
    {
        $this->shield = new \app\db\builder\Shield();
    }

    public function testRun1()
    {
        $actual = $this->shield->run('test');
        $this->assertEquals('`test`', $actual);
    }

    public function testRun2()
    {
        $actual = $this->shield->run('test   as   as_test');
        $this->assertEquals('`test` AS `as_test`', $actual);
    }

    public function testRun3()
    {
        $actual = $this->shield->run('  db.test as as_test   ');
        $this->assertEquals('`db`.`test` AS `as_test`', $actual);
    }

    public function testRun4()
    {
        $actual = $this->shield->run('  db  .   test AS as_test   ');
        $this->assertEquals('`db`.`test` AS `as_test`', $actual);
    }
}