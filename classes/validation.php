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
    */
    public static function comma($param)
    {
        if(strpos($param, ',') !== false)
        {
            return str_replace(',', '.', $param);
        }
        else
        {
            return $param;
        }
    }   
    
    // -------------------------------------------------------------------------
    
    /**
    * Clears string of special characters
    * 
    * @param String $variable
    * @param Bool $trim
    */
    function clear_string($variable, $trim=TRUE)
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
    
    return $variable;
    }   
    
    // -------------------------------------------------------------------------
    
    /**
    * Clears integer - returns zero if not propper
    * 
    * @param String $variable
    */
    function clear_number($variable)
    {
        if(is_numeric($variable))
        {
          $variable = $variable;
        }
        else
        {
          $variable = '0';
        }
    
    return $variable;
    }
    
    // -------------------------------------------------------------------------
}
?>