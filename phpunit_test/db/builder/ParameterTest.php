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
        $this->parameter = new \app\db\builder\PreparedStatement();
    }

    public function testFilter1()
    {
        $this->parameter->setPreparedStatements([':param1' => 'response']);
        $str = $this->parameter->bindParam('str=:param1');
        $identify = \unit\db\builder\Helper::identify();
        $this->assertEquals('str=' . $identify, $str);
        $this->assertEquals([$identify => 'response'], $this->parameter->getPreparedParameters());
    }

    public function testBindValue1()
    {
        $str = $this->parameter->bindValue('str', 'param');
        $identify = \unit\db\builder\Helper::identify();
        $this->assertEquals('str=' . $identify, $str);
        $this->assertEquals([$identify => 'param'], $this->parameter->getPreparedParameters());
    }

}