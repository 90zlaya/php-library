<?php
/*
| -------------------------------------------------------------------
| OPERATING SYSTEM
| -------------------------------------------------------------------
|
| Working with Operating System related data
|
| -------------------------------------------------------------------
*/
namespace phplibrary;

class Operating_System {
    protected static $operating_systems = array(
        array(
            'name' => 'Windows',
        ),
        array(
            'name' => 'BlackBerry',
        ), 
        array(
            'name' => 'Android',
        ), 
        array(
            'name' => 'iOS',
        ), 
        array(
            'name' => 'Linux',
        ),
    );
    
    // -------------------------------------------------------------------------
    
    /**
    * Gets operating systems list
    *
    * @return Array
    */
    public static function get_list()
    {
        return self::$operating_systems;
    }
    
    // -------------------------------------------------------------------------
}
?>