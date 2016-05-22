<?php

/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 14.05.2016
 * Time: 8:13
 */

declare(strict_types=1);

class FakerToken extends \app\db\builder\Token
{
    protected function getNameToken() : string
    {
        return 'SELECT';
    }
}

class TokenTest extends \unit\db\builder\TokenHelper
{
    protected $token;

    public function setUp()
    {
        $this->token = new FakerToken();
        $shield = new \app\db\builder\Shield();
        $this->token->setShield($shield);
    }

    public function testArrangeStatement1()
    {
        $this->token->arrangeStatement('first');
        $this->assertEquals('SELECT `first`', $this->token->buildStatement());
    }

    public function testArrangeStatement2()
    {
        $this->token->arrangeStatement(['first', 'as_second' => 'second', 'third as as_third']);
        $this->assertEquals('SELECT `first`, `second` AS `as_second`, `third` AS `as_third`', $this->token->buildStatement());
    }
}