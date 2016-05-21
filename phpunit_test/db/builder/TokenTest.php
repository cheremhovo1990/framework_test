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
        $this->assertSqlStringEquals('`first`', $this->token->getTokens()[0]);
    }

    public function testArrangeStatement2()
    {
        $this->token->arrangeStatement(['first', 'as_second' => 'second', 'third as as_third']);
        $tokens = $this->token->getTokens();
        $this->assertSqlStringEquals('`first`', $tokens[0]);
        $this->assertSqlStringEquals('`second` AS `as_second`', $tokens[1]);
        $this->assertSqlStringEquals('`third` AS `as_third`', $tokens[2]);
    }
}