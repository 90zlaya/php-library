<?php
/**
* Math
*
* Mathematical operations and calculations
*
* @package      PHP_Library
* @subpackage   Core
* @category     Numericals
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace PHP_Library\Core\Numericals;

/**
* Mathematical operations and calculations
*/
class Math {

    /* ---------------------------------------------------------------------- */

    /**
    * Iterated value
    *
    * @var int
    */
    private static $iterator = 0;

    /* ---------------------------------------------------------------------- */

    /**
    * Even or odd boolean value
    *
    * @var bool
    */
    private static $bool = TRUE;

    /* ---------------------------------------------------------------------- */

    /**
    * Calculate percentage between two numbers
    *
    * @param int $smaller_number
    * @param int $larger_number
    *
    * @return array
    */
    public static function percentage($smaller_number, $larger_number)
    {
        if (empty($smaller_number) || empty($larger_number))
        {
            $percentage = 0;
        }
        else
        {
            $percentage = (100 * $smaller_number) / $larger_number;
        }

        return array(
            'value' => $percentage,
            'sign'  => $percentage . '%',
        );
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Even or odd value return
    *
    * @param string $value_1
    * @param string $value_2
    * @param bool $bool
    *
    * @return string
    */
    public static function even_or_odd($value_1, $value_2, $bool=FALSE)
    {
        $bool ? NULL : $bool = self::$bool;

        self::$bool = ! self::$bool;

        return $bool ? $value_1 : $value_2;
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Iterates attribute
    *
    * @param bool $to_reset
    *
    * @return int
    */
    public static function iterate($to_reset=FALSE)
    {
        $to_reset ? self::set_iterator() : NULL;

        return ++self::$iterator;
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Set iterator attribute
    *
    * @param int $value
    *
    * @return void
    */
    public static function set_iterator($value=0)
    {
        self::$iterator = $value;
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Get iterator attribute
    *
    * @return int self::$itterator
    */
    public static function get_iterator()
    {
        return self::$iterator;
    }

    /* ---------------------------------------------------------------------- */
}
