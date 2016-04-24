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

    public function testSelect()
    {
        $built1 = new \app\BuildQuery();
        $built1->select('name');
        $except1 = 'SELECT name';
        $this->assertEquals($except1, $built1->statament());

        $built2 = new \app\BuildQuery();
        $built2->select('first, second');
        $except2 = 'SELECT first, second';
        $this->assertEquals($except2, $built2->statament());

        $built3 = new \app\BuildQuery();
        $built3->select(['first', 'second']);
        $except3 = 'SELECT first, second';
        $this->assertEquals($except3, $built3->statament());

        $built4 = new \app\BuildQuery();
        $built4->select(['first' => 'one', 'second']);
        $except4 = 'SELECT one AS first, second';
        $this->assertEquals($except4, $built4->statament());
    }

    public function testFrom()
    {
        $built = new \app\BuildQuery();
        $built->from('Test');
        $except = ' FROM Test';
        $this->assertEquals($except, $built->statament());

        $built2 = new \app\BuildQuery();
        $built2->from('first, second');
        $except2 = ' FROM first, second';
        $this->assertEquals($except2, $built2->statament());

        $built3 = new \app\BuildQuery();
        $built3->from(['first', 'second']);
        $except3 = ' FROM first, second';
        $this->assertEquals($except3, $built3->statament());

        $built4 = new \app\BuildQuery();
        $built4->from(['first' => 'one', 'second']);
        $except4 = ' FROM one AS first, second';
        $this->assertEquals($except4, $built4->statament());
    }

    public function testSelectAndFrom()
    {
        $built = new \app\BuildQuery();
        $built->select('name');
        $built->from('Test');

        $except = 'SELECT name FROM Test';
        $this->assertEquals($except, $built->statament());
    }

    public function testWhere()
    {
        $built1 = new \app\BuildQuery();
        $built1->where(['and', 'first=first', 'second=second']);

        $except = ' WHERE first=first AND second=second';
        $this->assertEquals($except, $built1->statament());

        $built2 = new \app\BuildQuery();
        $built2->where(['or', 'first=first', 'second=second']);

        $except = ' WHERE first=first OR second=second';
        $this->assertEquals($except, $built2->statament());
    }
}