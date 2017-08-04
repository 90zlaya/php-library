<?php
    class Temperature{
        public static $absoluteZero = 273.15;
        
        public static function k_to_c($temp) {
            if( !is_numeric($temp) ){ 
                return false;
            }
        return round(($temp - self::$absoluteZero)). '&deg;';
        }   
        
        public static function k_to_f($temp) {
            if ( !is_numeric($temp) ){ 
                return false; 
            }
        return round((($temp - self::$absoluteZero) * 1.8) + 32);
        }
    }
?>