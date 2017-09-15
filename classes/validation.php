<?php
/**
* Validation methods
*/
class Validation{
    
    // -------------------------------------------------------------------------
    
    /**
    * Validates year format
    * 
    * @param int $year
    * 
    * @return Bool
    */
    public static function year($year)
    {
        if(is_numeric($year) and strlen($year) === 4)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Checks if variable is set and non-empty
    * 
    * @param mixed $variable
    * 
    * @return Bool
    */
    public static function variables($variable)
    {
        if(isset($variable) and !empty($variable))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Replaces comma with dot
    * 
    * @param String $param
    * 
    * @return String $comma
    */
    public static function comma($param)
    {
        if(strpos($param, ',') !== false)
        {
            $comma = str_replace(',', '.', $param);
        }
        else
        {
            $comma = $param;
        }
        
        return $comma;
    }   
    
    // -------------------------------------------------------------------------
    
    /**
    * Clears string of special characters
    * 
    * @param String $variable
    * @param Bool $trim
    * 
    * @return mixed
    */
    public static function clear_string($variable, $trim=TRUE)
    {
        if(empty($variable))
        {
            return FALSE;
        }
        else
        {
            if($trim)
            {
                $variable = trim($variable);
            }
            
            $variable = str_ireplace('"',"",$variable);
            $variable = str_ireplace("'","",$variable);
            $variable = str_ireplace("(","",$variable);
            $variable = str_ireplace(")","",$variable);
            $variable = str_ireplace("/","",$variable);
            $variable = str_ireplace(";","",$variable);
            $variable = str_ireplace("*","",$variable);
            $variable = str_ireplace(">","",$variable);
            $variable = str_ireplace("<","",$variable);
        
            return $variable;
        }
    }   
    
    // -------------------------------------------------------------------------
    
    /**
    * Clears integer - returns zero if not propper
    * 
    * @param String $variable
    * 
    * @return int $cleared_number
    */
    public static function clear_number($variable)
    {
        if(is_numeric($variable))
        {
          $cleared_number = $variable;
        }
        else
        {
          $cleared_number = 0;
        }
    
        return $cleared_number;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Rewriting string parameters
    * 
    * @param String $string
    * 
    * @return mixed
    */
    public static function rewrite($string)
    {
        if(empty($string))
        {
            return FALSE;
        }
        else
        {
            $string_rewriten = strtolower($string);
            $string_rewriten = str_replace(' ', '_', $string_rewriten);
            $string_rewriten = preg_replace("/[^a-z-0-9-.]+/", "_", $string_rewriten);
          
            return $string_rewriten;
       }
    }
    
    // -------------------------------------------------------------------------
}
?>