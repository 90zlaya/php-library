<?php
/*
| -------------------------------------------------------------------
| MATH
| -------------------------------------------------------------------
|
| Mathematical operations and calculations
|
| -------------------------------------------------------------------
*/
namespace phplibrary;

class Math {
    public static $iterator = 0;
    
    private static $bool = TRUE;
    
    // -------------------------------------------------------------------------
    
    /**
    * Calculate percentage between two numbers
    * 
    * @param int $smaller_number
    * @param int $larger_number
    * 
    * @return Array
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
    
    // -------------------------------------------------------------------------

    /**
    * Even or odd value return
    * 
    * @param String $value_1
    * @param String $value_2
    * 
    * @return String
    */
    public static function even_or_odd($value_1, $value_2, $bool=FALSE)
    {
        $bool ? NULL : $bool = self::$bool;
        
        self::$bool = ! self::$bool;
        
        return $bool ? $value_1 : $value_2;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Iterates variable
    * 
    * @param Bool $to_reset
    * 
    * @return int
    */
    public static function iterate($to_reset=FALSE)
    {
        $to_reset ? self::$iterator = 0 : NULL;
        
        return ++self::$iterator;
    }
    
    // -------------------------------------------------------------------------
}
?>