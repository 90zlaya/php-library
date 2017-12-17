<?php
/*
| -------------------------------------------------------------------
| USER
| -------------------------------------------------------------------
|
| Works with user related data
|
| -------------------------------------------------------------------
*/
namespace phplibrary;

class User {
    protected static $image_location = 'data/users/';
    protected static $image_default  = 'assets/img/user.png';
    
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