<?php
/**
* Temperature
*
* Working with temperature conversions
*
* @package      PHP_Library
* @subpackage   Core
* @category     Numericals
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace PHP_Library\Core\Numericals;

/**
* Working with temperature conversions
*/
class Temperature {

    /* ---------------------------------------------------------------------- */

    /**
    * Absolute zero value
    *
    * @var float
    */
    private static $absolute_zero = 273.15;

    /* ---------------------------------------------------------------------- */

    /**
    * Temperature signs
    *
    * @var array
    */
    private static $signs = array(
        'celsius'    => '&degC',
        'fahrenheit' => 'F',
        'kelvin'     => 'K',
    );

    /* ---------------------------------------------------------------------- */

    /**
    * Create return values
    *
    * @param float $value
    * @param string $type
    *
    * @return array
    */
    private static function create_return_values($value, $type)
    {
        $sign  = $value;
        $sign .= ' ';
        $sign .= self::$signs[$type];

        return array(
            'value'   => $value,
            'rounded' => intval(round($value)),
            'signed'  => $sign,
        );
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Kelvin to Celsius conversion
    *
    * @param float $temp
    *
    * @return mixed
    */
    public static function k_to_c($temp)
    {
        $value = (floatval($temp) - self::$absolute_zero);
        return self::create_return_values($value, 'celsius');
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Kelvin to Fahrenheit conversion
    *
    * @param float $temp
    *
    * @return mixed
    */
    public static function k_to_f($temp)
    {
        $value = ((floatval($temp) - self::$absolute_zero) * (9 / 5)) + 32;
        return self::create_return_values($value, 'fahrenheit');
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Fahrenheit to Celsius conversion
    *
    * @param float $temp
    *
    * @return mixed
    */
    public static function f_to_c($temp)
    {
        $value = (floatval($temp) - 32) * (5 / 9);
        return self::create_return_values($value, 'celsius');
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Fahrenheit to Kelvin conversion
    *
    * @param float $temp
    *
    * @return mixed
    */
    public static function f_to_k($temp)
    {
        $value = (floatval($temp) + 459.67) * (5 / 9);
        return self::create_return_values($value, 'kelvin');
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Celsius to Fahrenheit conversion
    *
    * @param float $temp
    *
    * @return mixed
    */
    public static function c_to_f($temp)
    {
        $value = (floatval($temp) * (9 / 5)) + 32;
        return self::create_return_values($value, 'fahrenheit');
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Celsius to Kelvin conversion
    *
    * @param float $temp
    *
    * @return mixed
    */
    public static function c_to_k($temp)
    {
        $value = floatval($temp) + self::$absolute_zero;
        return self::create_return_values($value, 'kelvin');
    }

    /* ---------------------------------------------------------------------- */
}
