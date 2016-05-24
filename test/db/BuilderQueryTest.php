<?php

declare(strict_types=1);

class BuilderQueryTest extends PHPUnit_Framework_TestCase
{
    private $builder;

    public function setUp()
    {
        $this->builder = new fra\db\BuilderQuery();
    }

    public function testGetSql1()
    {
        $this->builder
            ->select('select_1')
            ->from('from_1')
            ->where('str=param');
        $this->assertEquals('SELECT `select_1` FROM `from_1` WHERE (str=param)', $this->builder->getSql());
    }

    public function testGetSql2()
    {
        $this->builder
            ->select(['first', 'as_second' => 'second', 'third as as_third'])
            ->from(['four', 'as_fifth' => 'fifth', 'sixth as as_sixth'])
            ->where('str=param');
        $this->assertEquals('SELECT `first`, `second` AS `as_second`, `third` AS `as_third` FROM `four`, `fifth` AS `as_fifth`, `sixth` AS `as_sixth` WHERE (str=param)', $this->builder->getSql());
    }
}