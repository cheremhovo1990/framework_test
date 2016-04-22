<?php

class Test {}


class DbTest extends \Codeception\TestCase\Test
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


    public function testExecute()
    {
        $db = new \app\Db();
        $sql = 'INSERT INTO Test(name) VALUES (:SECOND)';
        $res = $db->execute($sql, [':SECOND' => 'SECOND']);
        $this->assertTrue($res);
    }

    public function testQuery()
    {
        $db = new \app\Db();
        $sql = 'SELECT * FROM Test';
        $res = $db->query($sql, [], Test::class);

        $this->assertNotEmpty($res);
    }
}