<?php


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

    // tests
    public function testExecute()
    {
        $db = new \app\Db();
        $sql = 'INSERT INTO Test(name) VALUES (:SECOND)';
        $res = $db->execute($sql, [':SECOND' => 'SECOND']);
        $this->assertTrue($res);
    }
}