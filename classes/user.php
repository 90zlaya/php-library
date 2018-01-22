<?php
/**
* User
*
* Works with user related data
*
* @package      PHP Library
* @subpackage   phplibrary
* @category     Files
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace phplibrary;

/**
* Works with user related data
*/
class User {
    /**
    * Default location of images folder
    * 
    * @var String
    */
    protected static $image_location = 'data/users/';
    
    // -------------------------------------------------------------------------
    
    /**
    * Default image location
    * 
    * @var String
    */
    protected static $image_default  = 'https://php-library.zlatanstajic.com/assets/img/user.png';
    
    // -------------------------------------------------------------------------
    
    /**
    * Searches for user's image
    * 
    * @param String $image
    * @param String $image_location
    * @param String $image_default
    * 
    * @return String $image_link
    */
    public static function image($image, $image_location='', $image_default='')
    {
        $location = empty($image_location) ? self::$image_location : $image_location;
        $default  = empty($image_default) ? self::$image_default : $image_default;
        
        $image_link = $location . $image;
        
        if ( ! @getimagesize($image_link) || empty($image))
        {
            $image_link = &$default;
        }
        
        return $image_link;
    }
    
    // -------------------------------------------------------------------------
}
?>