<?php

declare(strict_types = 1);

class UpdateTest extends PHPUnit_Framework_TestCase
{
    public $insert;

    public function setUp()
    {
        $this->insert = new fra\db\builder\Update();
        $this->insert->setPreparedStatement(new fra\db\builder\PreparedStatement());
    }

    public function testArrangeStatement1()
    {
        $this->insert->arrangeStatement(['table1', 'name1' => 'Title1', 'name2' => 'Title2']);
        $identify1 = \unit\db\builder\Helper::identify();
        $identify2 = \unit\db\builder\Helper::identify();
        $this->assertEquals('UPDATE table1 SET name1=' . $identify1 . ', ' . 'name2=' . $identify2, $this->insert->buildStatement());
    }
}