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
    public static $image_location = 'data/users/';
    public static $image_default  = 'assets/images/user.png';
    
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
        empty($image_location) ? $image_location = self::$image_location : NULL;
        empty($image_default) ? $image_default = self::$image_default : NULL;
        
        $image_link = $image_location . $image;
        
        if (!getimagesize($image_link) || empty($image))
        {
            $image_link = $image_default;
        }
        
        return $image_link;    
    }
    
    // -------------------------------------------------------------------------
}
?>