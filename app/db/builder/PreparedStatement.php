<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 17.05.2016
 * Time: 9:33
 */

declare(strict_types=1);

namespace app\db\builder;


class PreparedStatement
{
    protected $parameters = [];
    protected $actuals = [];
    protected $whereSting = [];

    public function getParameters() : array
    {
        return $this->parameters;
    }

    public function setParameters(array $parameters)
    {
        $this->parameters = $this->parameters + $parameters;
    }

    public function filter(string $str)
    {
        foreach ($this->getParameters() as $key => $value) {
            if (strpos($str, $key) != false) {
                $identify = static::identify();
                $str = str_replace($key, $identify, $str);
                $this->setActuals([$identify => $value]);
            }
        }
        return $str;
    }

    public function setActuals(array $actuals)
    {
        $this->actuals = $this->actuals + $actuals;
    }

    public function getActuals() : array
    {
        return $this->actuals;
    }

    public static function identify()
    {
        static $number = 0;
        $identify = ':bq' . $number;
        $number++;
        return $identify;
    }

    public function addWhereString(WhereString $WhereString)
    {
        if (strpos($WhereString->getString(), ':') != false) {
            $this->whereSting[] = $WhereString;
        }
    }

    public function convert($string, $parameter)
    {
        $identify = static::identify();
        $string .= '=' . $identify;
        $this->setActuals([$identify => $parameter]);
        return $string;
    }
}