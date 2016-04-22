<?php


class BuildQueryTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSelect()
    {
        $built = new \app\BuildQuery();
        $built->select('name');

        $except = 'SELECT name';
        $this->assertEquals($except, $built->statament());
    }

    public function testFrom()
    {
        $built = new \app\BuildQuery();
        $built->from('Test');

        $except = ' FROM Test';
        $this->assertEquals($except, $built->statament());
    }

    public function testSlectAndFrom()
    {
        $built = new \app\BuildQuery();
        $built->select('name');
        $built->from('Test');

        $except = 'SELECT name FROM Test';
        $this->assertEquals($except, $built->statament());
    }
}