<?php
/*
| -------------------------------------------------------------------
| PASSWORD
| -------------------------------------------------------------------
|
| Works with password related data
|
| -------------------------------------------------------------------
*/
namespace phplibrary;

class Password{
    protected static $size_minimum = 6;
    protected static $size_optimum = 9;
    protected static $letters      = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    protected static $words        = 'dog,cat,sheep,sun,sky,red,ball,happy,ice,green,blue,music,movies,radio,green,turbo,mouse,computer,paper,water,fire,storm,chicken,boot,freedom,white,nice,player,small,eyes,path,kid,box,black,flower,ping,pong,smile,coffee,colors,rainbow,plus,king,tv,ring';
    
    // -------------------------------------------------------------------------
    
    /**
    * Generates new password
    * 
    * @param int $size_optimum
    * @param String $letters
    * 
    * @return String $new_password
    */
    public static function new($size_optimum=0, $letters='')
    {
        if(empty($size_optimum))
        {
            $size_optimum = self::$size_optimum;
        }
        
        if(empty($letters))
        {
            $letters = self::$letters;
        }
            
        $new_password = substr(str_shuffle($letters), 0, $size_optimum);
            
        return $new_password;
    }
    
    // -------------------------------------------------------------------------

    /**
    * Generates new readable password
    * 
    * @param int $size_optimum
    * @param String $words
    * 
    * @return String $new_password
    */
    public static function new_readable($size_optimum=0, $words=''){
        if(empty($size_optimum))
        {
            $size_optimum = self::$size_optimum;
        }
        
        if(empty($words))
        {
            $words = self::$words;
        }
        
        $words = explode(',', $words);
        $new_password = '';
        while(strlen($new_password) < $size_optimum)
        {
          $r = mt_rand(0, count($words)-1);
          $new_password .= $words[$r];
        }
        
        $number = mt_rand(1000, 9999);
        if($size_optimum > 2)
        {
            $new_password = substr($new_password, 0, $size_optimum-strlen($number)) . $number;
        }
        else
        {
            $new_password = substr($new_password, 0, $size_optimum);
        }

        return $new_password;
    } 
  
    // -------------------------------------------------------------------------
    
    /**
    * Calculates password strength
    * 
    * @param String $string
    * @param Bool $return_boolean
    * @param int $minimum_strength_percent
    * 
    * @return Bool $result
    */
    public static function strength($string, $return_boolean=TRUE, $minimum_strength_percent='60')
    {
        $h = 0;
        $size = strlen($string);
        
        if($size >= self::$size_minimum && ctype_alnum($string))
        {
            foreach(count_chars($string, 1) as $v)
            {
                $p = $v / $size;
                $h -= $p * log($p) / log(2);
            }
            
            $strength = ($h / 4) * 100;
            
            if($strength > 100)
            {
                $strength = 100;
            }
        }
        else
        {
            $strength = 0;    
        }
        
        if($strength > $minimum_strength_percent)
        {
            $flagStrength = true;
        }
        else
        {
            $flagStrength = false;
        }   
        
        if($return_boolean)
        {
            $result = $flagStrength;
        }
        else
        {
            $result = $strength;
        }
    
        return $result;
    }    
    
    // -------------------------------------------------------------------------
    
    /**
    * Base 64 encode
    * 
    * @param String $plainText
    * 
    * @return String $encoded
    */
    public static function encode($plainText)
    {
        $plainText = base64_encode($plainText);
        $encoded = strtr($plainText, '+/=', '-_,');
        
        return $encoded;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Base 64 decode
    * 
    * @param String $plainText
    * 
    * @return String $decoded
    */
    public static function decode($plainText)
    {
        $plainText = strtr($plainText, '-_,', '+/=');
        $decoded = base64_decode($plainText);
        
        return $decoded;
    }
    
    // -------------------------------------------------------------------------
}
?>