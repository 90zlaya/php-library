<?php
/**
* Validation
*
* Validation methods
*
* @package      PHP Library
* @subpackage   phplibrary
* @category     Validation
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace phplibrary;

/**
* Validation methods
*/
class Validation {
    
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
        if (is_numeric($year) && strlen($year) === 4)
        {
            return TRUE;
        }
        
        return FALSE;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Checks if variable is set and non-empty
    * 
    * @param String $variable
    * 
    * @return Bool
    */
    public static function variables($variable)
    {
        if ( ! empty($variable))
        {
            return TRUE;
        }
        
        return FALSE;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Replaces comma with dot
    * 
    * @param String $param
    * 
    * @return String
    */
    public static function comma($param)
    {
        if (strpos($param, ',') !== FALSE)
        {
            return str_replace(',', '.', $param);
        }
        
        return $param;
    }   
    
    // -------------------------------------------------------------------------
    
    /**
    * Clears string of special characters
    * 
    * @param String $variable
    * @param Bool $to_trim
    * 
    * @return mixed
    */
    public static function clear_string($variable, $to_trim=TRUE)
    {
        if ( ! empty($variable))
        {
            if ($to_trim)
            {
                $variable = trim($variable);
            }
            
            $variable = str_ireplace('"', "", $variable);
            $variable = str_ireplace("'", "", $variable);
            $variable = str_ireplace("(", "", $variable);
            $variable = str_ireplace(")", "", $variable);
            $variable = str_ireplace("/", "", $variable);
            $variable = str_ireplace(";", "", $variable);
            $variable = str_ireplace("*", "", $variable);
            $variable = str_ireplace(">", "", $variable);
            $variable = str_ireplace("<", "", $variable);
        
            return $variable;
        }
        
        return FALSE;
    }   
    
    // -------------------------------------------------------------------------
    
    /**
    * Clears integer - returns zero if not propper
    * 
    * @param String $variable
    * 
    * @return int
    */
    public static function clear_number($variable)
    {
        return is_numeric($variable) ? (int) $variable : 0;
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
        if ( ! empty($string))
        {
            $string = strtolower($string);
            $string = str_replace(' ', '_', $string);
            $string = preg_replace("/[^a-z-0-9-.]+/", "_", $string);
          
            return $string;
        }
        
        return FALSE;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Rewriting string parameters with special characters
    * 
    * @param String $string
    * 
    * @return mixed
    */
    public static function rewrite_special($string)
    {
        if ( ! empty($string))
        {
            $special_characters = array(
                'Ć' => 'ć',
                'Č' => 'č',
                'Ž' => 'ž',
                'Š' => 'š',
            );
            
            $string_replaced = strtr($string, $special_characters);
            $string_lowered  = strtolower($string_replaced);
            
            $string_lowered = str_ireplace('ć', 'c', $string_lowered);
            $string_lowered = str_ireplace('č', 'c', $string_lowered);
            $string_lowered = str_ireplace('ž', 'z', $string_lowered);
            $string_lowered = str_ireplace('š', 's', $string_lowered);
            $string_lowered = str_ireplace('đ', 'dj', $string_lowered);
            $string_lowered = str_ireplace('Đ', 'dj', $string_lowered);
            
            $string_replaced = preg_replace('/_[a-zA-Z0-9]+(\.)/', '.', $string_lowered, 1);
            $string_trimmed  = trim($string_replaced);
            
            $string_trimmed = str_ireplace(" ", "_", $string_trimmed);
            $string_trimmed = str_ireplace("__", "_", $string_trimmed);
            $string_trimmed = str_ireplace("___", "_", $string_trimmed);
            $string_trimmed = str_ireplace("(", "", $string_trimmed);
            $string_trimmed = str_ireplace(")", "", $string_trimmed);
            $string_trimmed = str_ireplace('"', "", $string_trimmed);
            $string_trimmed = str_ireplace("'", "", $string_trimmed);
            $string_trimmed = str_ireplace(" ", "_", $string_trimmed);
            $string_trimmed = str_ireplace("(", "", $string_trimmed);
            $string_trimmed = str_ireplace(")", "", $string_trimmed);
            $string_trimmed = str_ireplace("%", "", $string_trimmed);
            
            return $string_trimmed;
        }
        
        return FALSE;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Checks if file extension is valid or not
    * 
    * @param String $file
    * @param Array $allowed_extensions
    * @param String $type
    * @param Array $allowed_types
    * 
    * @return Bool
    */
    public static function extension($file, $allowed_extensions, $type='', $allowed_types=array())
    {
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        $extension = strtolower($extension);
        
        if 
        (
            in_array($extension, $allowed_extensions) && 
            (empty($type) || empty($allowed_types) || in_array($type, $allowed_types))
        )
        {
            return TRUE;
        }
        
        return FALSE;
    }
    
    // -------------------------------------------------------------------------
}
