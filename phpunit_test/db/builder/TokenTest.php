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

class TokenTest extends PHPUnit_Framework_TestCase
{
    public $token;

    public function setUp()
    {
        $this->token = new FakerToken();
    }

    public function testParser1()
    {
        $this->token->parser('first');
        /* @var $string \app\db\builder\SqlString */
        $string = $this->token->getTokens()[0];
        $this->assertInstanceOf(\app\db\builder\SqlString::class, $string);
        $this->assertEquals('first', $string->getString());
    }

    public function testParser2()
    {
        $this->token->parser(['first', 'as_second' => 'second', 'third as as_third']);
        $tokens = $this->token->getTokens();
        $this->assertInstanceOf(\app\db\builder\SqlString::class, $tokens[0]);
        $this->assertEquals('first', $tokens[0]->getString());
        $this->assertInstanceOf(\app\db\builder\SqlString::class, $tokens[1]);
        $this->assertEquals('second AS as_second', $tokens[1]->getString());
        $this->assertInstanceOf(\app\db\builder\SqlString::class, $tokens[2]);
        $this->assertEquals('third as as_third', $tokens[2]->getString());
    }
}