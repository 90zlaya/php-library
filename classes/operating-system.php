<?php
/**
* Working with OS-related data and methods
*/
class Operating_System{
    public static $first  = 'Windows';
    public static $second = 'BlackBerry';
    public static $third  = 'Android';
    public static $fourth = 'iOS';
    public static $fifth  = 'Linux';
    
    // -------------------------------------------------------------------------
    
    /**
    * Gets operating systems list
    *
    */
    public static function get_list()
    {
        return array(
            self::$first,
            self::$second,
            self::$third,
            self::$fourth,
            self::$fifth
        );
    }
    
    // -------------------------------------------------------------------------
}
?>