<?php
    class User{
        public static $image_location = 'data/korisnici/';
        public static $image_default  = 'images/user.png';
        
        public static function recordIP(){
            return $_SERVER['REMOTE_ADDR'];
        }
        
        public static function recordUA(){
            return $_SERVER['HTTP_USER_AGENT'];
        }
        
        public static function image($image, $image_location='', $image_default=""){
            if( empty($image_location) ){
                $image_location = self::$image_location;
            }
            
            if( empty($image_default) ){
                $image_default = self::$image_default;
            }
            
            $image_link = $image_location . $image;
            if( !file_exists($image_link) or empty($image) ){
                if( !file_exists('../'. $image_link) or empty($image) ){
                    $image_link = $image_default;
                }
            }
        return $image_link;    
        }
    }
?>