<?php

declare(strict_types=1);

use app\db\BaseBuilder;

class FakerBaseBuilder extends BaseBuilder
{

}

class BaseBuilderTest extends \unit\_helper\Helper
{
    public function testParser()
    {
        $builder = new FakerBaseBuilder();
        $this->callMethod($builder, 'arrangeStatement', ['select', 'column']);
        $selectString = $this->selectString($builder);
        $this->assertEquals('`column`', $selectString[0]->getString());

        $builder = new FakerBaseBuilder();
        $this->callMethod($builder, 'arrangeStatement', ['select', ['first', 'as_second' => 'second', 'third as as_third']]);
        $selectString = $this->selectString($builder);
        $this->assertEquals('`first`', $selectString[0]->getString());
        $this->assertEquals('`second` AS `as_second`', $selectString[1]->getString());
        $this->assertEquals('`third` AS `as_third`', $selectString[2]->getString());
    }

    private function selectString($object)
    {
        $statement = $this->getfield($object, 'statement');
        $select = $this->getfield($statement, 'statements');
        foreach ($select as $elem) {
            if ($elem instanceof \app\db\builder\Select) {
                $selectString = $this->getfield($elem, 'tokens');
                return $selectString;
            }
        }
    }
}