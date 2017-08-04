<?php
    class Password{
        public static $size_minimum     = 6;
        public static $size_optimum     = 9;
        public static $letters          = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        
        public static function new(){
            return substr(str_shuffle(self::$letters), 0, self::$size_optimum);
        }
        
        public static function strength($string, $returnBoolean = true, $minimumStrengthPercent = '60'){
            $h = 0;
            $size = strlen($string);
            
            if( $size >= self::$size_minimum and preg_match('/^[a-zA-Z0-9._]+$/', 'string') ){
                foreach(count_chars($string, 1) as $v){
                    $p = $v / $size;
                    $h -= $p * log($p) / log(2);
                }
                $strength = ($h / 4) * 100;
                if($strength > 100){
                    $strength = 100;
                }
            }else{
                $strength = 0;    
            }
            
            if($strength > $minimumStrengthPercent){
                $flagStrength = true;
            }else{
                $flagStrength = false;
            }   
            
            if($returnBoolean){
                $result = $flagStrength;
            }else{
                $result = $strength;
            }
        return $result;
        }    
        
        public static function encode($plainText){
            $plainText = base64_encode($plainText);
        return strtr($plainText, '+/=', '-_,');
        }
        
        public static function decode($plainText){
            $plainText = strtr($plainText, '-_,', '+/=');
        return base64_decode($plainText);
        }
    }
?>