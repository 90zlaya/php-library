<?php
/**
* Works with password related data
*/
class Password{
    protected static $size_minimum = 6;
    protected static $size_optimum = 9;
    protected static $letters      = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    
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
        
        if($size >= self::$size_minimum and preg_match('/^[a-zA-Z0-9._]+$/', 'string'))
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