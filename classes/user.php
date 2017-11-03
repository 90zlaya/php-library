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

class User{
    public static $image_location = 'data/users/';
    public static $image_default  = 'assets/images/user.png';
    
    // -------------------------------------------------------------------------
    
    /**
    * Records user's IP address
    * 
    * @return String $_SERVER['REMOTE_ADDR']
    */
    public static function record_ip()
    {
        return $_SERVER['REMOTE_ADDR'];
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Records user's User Agent
    * 
    * @return String $_SERVER['HTTP_USER_AGENT']
    */
    public static function record_ua()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }
    
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
        if(empty($image_location))
        {
            $image_location = self::$image_location;
        }
        
        if(empty($image_default))
        {
            $image_default = self::$image_default;
        }
        
        $image_link = $image_location . $image;
        
        if(!getimagesize($image_link) || empty($image))
        {
            $image_link = $image_default;
        }
        
        return $image_link;    
    }
    
    // -------------------------------------------------------------------------
}
?>