<?php
/**
* Password
*
* Works with password related data
*
* @package      PHP Library
* @subpackage   phplibrary
* @category     Password
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace phplibrary;

/**
* Works with password related data
*/
class Password {
    /**
    * Minimum password size
    * 
    * @var int
    */
    protected static $size_minimum = 6;
    
    // -------------------------------------------------------------------------
    
    /**
    * Optimum password size
    * 
    * @var int
    */
    protected static $size_optimum = 9;
    
    // -------------------------------------------------------------------------
    
    /**
    * Password letters
    * 
    * @var String
    */
    protected static $letters = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    
    // -------------------------------------------------------------------------
    
    /**
    * Password words
    * 
    * @var String
    */
    protected static $words = 'dog,cat,sheep,sun,sky,red,ball,happy,ice,green,blue,music,movies,radio,green,turbo,mouse,computer,paper,water,fire,storm,chicken,boot,freedom,white,nice,player,small,eyes,path,kid,box,black,flower,ping,pong,smile,coffee,colors,rainbow,plus,king,tv,ring';
    
    // -------------------------------------------------------------------------
    
    /**
    * Generates new unreadable password
    * 
    * @param int $size_optimum
    * @param String $letters
    * 
    * @return String
    */
    public static function new_unreadable($size_optimum=0, $letters='')
    {
        empty($size_optimum) ? $size_optimum = self::$size_optimum : NULL;
        empty($letters) ? $letters = self::$letters : NULL;
            
        return substr(str_shuffle($letters), 0, $size_optimum);
    }
    
    // -------------------------------------------------------------------------

    /**
    * Generates new readable password
    * 
    * @param int $size_optimum
    * @param String $words
    * 
    * @return String
    */
    public static function new_readable($size_optimum=0, $words='')
    {
        empty($size_optimum) ? $size_optimum = self::$size_optimum : NULL;
        empty($words) ? $words = self::$words : NULL;
        
        $words          = explode(',', $words);
        $new_password   = '';
        while (strlen($new_password) < $size_optimum)
        {
          $r = mt_rand(0, count($words)-1);
          $new_password .= $words[$r];
        }
        
        $number = mt_rand(1000, 9999);
        if ($size_optimum > 2)
        {
            return substr($new_password, 0, $size_optimum-strlen($number)) . $number;
        }
        else
        {
            return substr($new_password, 0, $size_optimum);
        }
    } 
  
    // -------------------------------------------------------------------------
    
    /**
    * Calculates password strength
    * 
    * @param String $string
    * @param Bool $return_boolean
    * @param int $minimum_strength_percent
    * 
    * @return mixed
    */
    public static function strength($string, $return_boolean=TRUE, $minimum_strength_percent=60)
    {
        $h = 0;
        $size = strlen($string);
        
        if ($size >= self::$size_minimum)
        {
            foreach (count_chars($string, 1) as $v)
            {
                $p = $v / $size;
                $h -= $p * log($p) / log(2);
            }
            
            $strength = ($h / 4) * 100;
            $strength > 100 ? $strength = 100 : NULL;
        }
        else
        {
            $strength = 0;    
        }
        
        return $return_boolean ? $strength > $minimum_strength_percent : $strength;
    }    
    
    // -------------------------------------------------------------------------
    
    /**
    * Base 64 encode
    * 
    * @param String $plainText
    * 
    * @return String
    */
    public static function encode($plainText)
    {
        return strtr(base64_encode($plainText), '+/=', '-_,');
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Base 64 decode
    * 
    * @param String $plainText
    * 
    * @return String
    */
    public static function decode($plainText)
    {
        return base64_decode(strtr($plainText, '-_,', '+/='));
    }
    
    // -------------------------------------------------------------------------
}
?>