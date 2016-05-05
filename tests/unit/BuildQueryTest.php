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
        $except1 = ' WHERE (first=first AND second=second)';
        $this->assertEquals($except1, $built1->statament());

        $built2 = new \app\BuildQuery();
        $built2->where(['or', 'first=first', 'second=second']);
        $except2 = ' WHERE (first=first OR second=second)';
        $this->assertEquals($except2, $built2->statament());

        $built3 = new \app\BuildQuery();
        $built3->where('status=1');
        $except3 = ' WHERE status=1';
        $this->assertEquals($except3, $built3->statament());
    }

    public function TestStatament()
    {
        $built = new \app\BuildQuery();
        $built->select(['first' => 'as_first', 'second']);
        $built->from(['table_first' => 'as_table_first', 'table_second']);
        $built->where(['and', 'str=1', ['or', 'str=2', ['in', 'in_str', [1, 2, 3]]]]);
        $except = 'SELECT first AS as_first, second
                    FROM table_first AS as_table_first, table_second
                    WHERE (str=1 AND (str=2 OR (in_str IN (1, 2, 3))))';

        $this->assertEquals($except, $built->statament());
    }
}