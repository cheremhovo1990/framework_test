<?php

/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 18.05.2016
 * Time: 9:19
 */

declare(strict_types=1);

class ParameterTest extends PHPUnit_Framework_TestCase
{
    private $parameter;

    public function setUp()
    {
        $this->parameter = new \app\db\builder\Parameter();
    }

    public function testFilter1()
    {
        $this->parameter->setParameters([':param1' => 'response']);
        $str = $this->parameter->filter('str=:param1');
        $identify = \unit\db\builder\Helper::identify();
        $this->assertEquals('str=' . $identify, $str);
        $this->assertEquals([$identify => 'response'], $this->parameter->getActuals());
    }

    public function testConvert1()
    {
        $str = $this->parameter->convert('str', 'param');
        $identify = \unit\db\builder\Helper::identify();
        $this->assertEquals('str=' . $identify, $str);
        $this->assertEquals([$identify => 'param'], $this->parameter->getActuals());
    }

}