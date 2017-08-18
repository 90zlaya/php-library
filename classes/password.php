<?php
/**
* Works with password related data
*/
class Password{
    public static $size_minimum = 6;
    public static $size_optimum = 9;
    public static $letters      = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    
    // -------------------------------------------------------------------------
    
    /**
    * Generates new password
    * 
    */
    public static function new()
    {
        return substr(str_shuffle(self::$letters), 0, self::$size_optimum);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Calculates password strength
    * 
    * @param String $string
    * @param Bool $return_boolean
    * @param int $minimum_strength_percent
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
    */
    public static function encode($plainText)
    {
        $plainText = base64_encode($plainText);
    
    return strtr($plainText, '+/=', '-_,');
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Base 64 decode
    * 
    * @param String $plainText
    */
    public static function decode($plainText)
    {
        $plainText = strtr($plainText, '-_,', '+/=');
    
    return base64_decode($plainText);
    }
    
    // -------------------------------------------------------------------------
}
?>