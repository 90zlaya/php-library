<?php
    class Validation{
        public static function year($year){
            if( is_numeric($year) and strlen($year) === 4 ){
                return true;
            }else{
                return false;
            }
        }  
        
        public static function variables($variable){
            if( isset($variable) and !empty($variable) ){
                return true;
            }else{
                return false;
            }
        }
        
        public static function comma($param){
            if(strpos($param, ',') !== false){
                return str_replace(',', '.', $param);
            }else{
                return $param;
            }
        }   
        
        function clear_string($variable, $trim=true){
            if($trim){
                $variable = trim($variable);
            }
            $variable = str_ireplace('"',"",$variable);
            $variable = str_ireplace("'","",$variable);
            $variable = str_ireplace("(","",$variable);
            $variable = str_ireplace(")","",$variable);
            $variable = str_ireplace("/","",$variable);
            $variable = str_ireplace(";","",$variable);
            $variable = str_ireplace("*","",$variable);
        return $variable;
        }   
        
        function clear_number($variable){
            if( is_numeric($variable) ){
              $variable = $variable;
            }else{
              $variable = '0';
            }
        return $variable;
        }
    }
?>