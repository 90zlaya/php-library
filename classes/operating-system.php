<?php
/**
* Operating_System
*
* Working with Operating System related data
*
* @package      PHP Library
* @subpackage   phplibrary
* @category     Data
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace phplibrary;

/**
* Working with Operating System related data
*/
class Operating_System {
    /**
    * List of operating systems
    * 
    * @var Array
    */
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
