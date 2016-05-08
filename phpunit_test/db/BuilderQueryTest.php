<?php

/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 07.05.2016
 * Time: 11:16
 */
class BuilderQueryTest extends PHPUnit_Framework_TestCase
{
    public function testSelect()
    {
        $builder = new app\db\BuilderQuery();
        $builder->select('column');
        $function = function($property){
            return $this->$property;
        };

        $function = $function->bindTo($builder, app\db\BuilderQuery::class);
        $statementBuilderQuery =  $function('statement');
        $this->assertInstanceOf(app\db\Statement::class, $statementBuilderQuery);

        $function = $function->bindTo($statementBuilderQuery, app\db\Statement::class);
        $arrayStatements =  $function('statements');
        $this->assertInstanceOf(app\db\StatementSelect::class,  $arrayStatements[0]);

        $function = $function->bindTo($arrayStatements[0], app\db\StatementSelect::class);
            var_dump($arrayStatements[0]);
        $arrayStatements =  $function('statements');

        //$this->assertInstanceOf(app\db\SelectString::class,  $arrayStatements[0]);

        var_dump($arrayStatements);
    }
}