<?php

declare(strict_types=1);

class FromTest extends \unit\_helper\Helper
{
    public function testParser()
    {
        $form = new \app\db\builder\Select();
        $form->parser('first');
        $froms = $form->getSelects()[0]->getString();
        $this->assertEquals('first', $froms );

        $form= new \app\db\builder\Select();
        $form->parser(['first', 'as_second' => 'second', 'third as as_third']);
        $froms = $form->getSelects();
        $this->assertEquals('first', $froms[0]->getString());
        $this->assertEquals('second AS as_second', $froms[1]->getString());
        $this->assertEquals('third as as_third', $froms[2]->getString());
    }
}