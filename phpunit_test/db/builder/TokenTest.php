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
    }

    public function testParser1()
    {
        $this->token->parser('first');
        $this->assertSqlStringEquals('first', $this->token->getTokens()[0]);
    }

    public function testParser2()
    {
        $this->token->parser(['first', 'as_second' => 'second', 'third as as_third']);
        $tokens = $this->token->getTokens();
        $this->assertSqlStringEquals('first', $tokens[0]);
        $this->assertSqlStringEquals('second AS as_second', $tokens[1]);
        $this->assertSqlStringEquals('third as as_third', $tokens[2]);
    }
}