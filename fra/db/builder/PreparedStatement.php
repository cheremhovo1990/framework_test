<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 17.05.2016
 * Time: 9:33
 */

declare(strict_types=1);

namespace fra\db\builder;


class PreparedStatement
{
    protected $parameters = [];
    protected $actuals = [];
    protected $whereSting = [];

    public function getPreparedStatements() : array
    {
        return $this->parameters;
    }

    public function setPreparedStatements(array $parameters)
    {
        $this->parameters = $this->parameters + $parameters;
    }

    public function bindParam(string $str)
    {
        foreach ($this->getPreparedStatements() as $key => $value) {
            if (strpos($str, $key) != false) {
                $identify = static::identify();
                $str = str_replace($key, $identify, $str);
                $this->setPreparedParameters([$identify => $value]);
            }
        }
        return $str;
    }

    public function setPreparedParameters(array $actuals)
    {
        $this->actuals = $this->actuals + $actuals;
    }

    public function getPreparedParameters() : array
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

    public function bindValue($string, $parameter)
    {
        $identify = static::identify();
        $string .= '=' . $identify;
        $this->setPreparedParameters([$identify => $parameter]);
        return $string;
    }
}