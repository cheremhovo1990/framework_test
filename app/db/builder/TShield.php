<?php

namespace app\db\builder;

trait TShield
{
    private $shield;

    public function setShield(Shield $shield)
    {
        $this->shield = $shield;
    }

    public function getShield() : Shield
    {
        return $this->shield;
    }
}