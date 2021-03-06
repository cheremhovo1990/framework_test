<?php

declare(strict_types = 1);

class FakeModel extends fra\db\Model
{
    const TABLE = "Test";
}


class ModelTest extends \PHPUnit_Extensions_Database_TestCase
{
    public function getConnection()
    {
        $pdo = new \PDO('sqlite:' . __DIR__ . '/../../data/db.db');
        return $this->createDefaultDBConnection($pdo, '');
    }

    public function getDataSet()
    {
        return $this->createXMLDataSet(__DIR__ . '/../_data/Test.xml');
    }

    public function testFindAll1()
    {
        $models = FakeModel::findAll();
        $this->assertEquals(1, $models[0]->id);
        $this->assertEquals('Tom', $models[0]->name);
        $this->assertEquals(Null, $models[0]->email);
    }

    public function testFindAll2()
    {
        $models = FakeModel::findAll();
        $this->assertEquals(2, $models[1]->id);
        $this->assertEquals('John', $models[1]->name);
        $this->assertEquals('test@email.com', $models[1]->email);
    }

    public function testFindById()
    {
        $model = FakeModel::findById(2);
        
        \unit\db\builder\Helper::identify();

        $this->assertEquals(2, $model->id);
        $this->assertEquals('John', $model->name);
        $this->assertEquals('test@email.com', $model->email);
    }

    public function testInsert()
    {
        \unit\db\builder\Helper::identify();
        \unit\db\builder\Helper::identify();
        \unit\db\builder\Helper::identify();

        $model = new FakeModel();
        $model->name = 'Robbert';
        $model->email = 'my@emial.com';
        $model->insert();

        $model1 = FakeModel::findById($model->id);


        $this->assertEquals($model->id, $model1->id);
        $this->assertEquals('Robbert', $model1->name);
        $this->assertEquals('my@emial.com', $model1->email);
    }

    public function testFind()
    {
        $model = FakeModel::find();
        $this->assertInstanceOf(fra\db\Model::class, $model);
    }

    public function testSelect()
    {
        $model = FakeModel::find()->select(['id', 'name']);
        $this->assertEquals('SELECT `id`, `name`', $model->getSql());
    }

    public function testFrom()
    {
        $model = FakeModel::find()->from(['id', 'name']);
        $this->assertEquals(' FROM `id`, `name`', $model->getSql());
    }

    public function testWhere()
    {
        $model = FakeModel::find()->where(['and', 'id' => 'name']);
        $identify = \unit\db\builder\Helper::identify();
        $this->assertEquals(' WHERE (id=' . $identify . ')', $model->getSql());
    }

    public function testUpdate()
    {
        \unit\db\builder\Helper::identify();
        \unit\db\builder\Helper::identify();
        \unit\db\builder\Helper::identify();
        \unit\db\builder\Helper::identify();


        $model1 = FakeModel::findById(2);
        $model1->name = 'Robbert';
        $model1->update();

        \unit\db\builder\Helper::identify();

        $model2 = FakeModel::findById(2);
        $this->assertEquals('Robbert', $model2->name);
    }
}