<?php
/*
| -------------------------------------------------------------------
| TEMPERATURE
| -------------------------------------------------------------------
|
| Working with temperature conversions
|
| -------------------------------------------------------------------
*/
namespace phplibrary;

class Temperature{
    protected static $absolute_zero = 273.15;
    protected static $signs         = array(
        'celsius'    => '&degC',
        'fahrenheit' => 'F',
        'kelvin'     => 'K',
    );
    
    // -------------------------------------------------------------------------
    
    /**
    * Kelvin to Celsius conversion
    *
    * @param float $temp
    * @param Bool $round_value
    * 
    * @return mixed
    */
    public static function k_to_c($temp, $round_value=FALSE)
    {
        if(is_numeric($temp))
        {
            $celsius = ($temp - self::$absolute_zero);
            
            if($round_value)
            {
                $celsius = round($celsius);
            }
            
            $celsius_with_sign = $celsius . ' ' . self::$signs['celsius'];
            
            $data = array(
                'value' => $celsius,
                'sign'  => $celsius_with_sign,
            );
            
            return $data;
        }
        else
        {
            return FALSE;
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Kelvin to Fahrenheit conversion
    *
    * @param float $temp
    * @param Bool $round_value
    * 
    * @return mixed
    */
    public static function k_to_f($temp, $round_value=FALSE)
    {
        if(is_numeric($temp))
        {
            $fahrenheit = (($temp - self::$absolute_zero) * (9 / 5)) + 32;
        
            if($round_value)
            {
                $fahrenheit = round($fahrenheit);
            }
            
            $fahrenheit_with_sign = $fahrenheit . ' ' . self::$signs['fahrenheit'];
            
            $data = array(
                'value' => $fahrenheit,
                'sign'  => $fahrenheit_with_sign,
            );
            
            return $data;
        }
        else
        {
            return FALSE;
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Fahrenheit to Celsius conversion
    *
    * @param float $temp
    * @param Bool $round_value
    * 
    * @return mixed
    */
    public static function f_to_c($temp, $round_value=FALSE)
    {
        if(is_numeric($temp))
        {
            $celsius = ($temp - 32) * (5 / 9);
        
            if($round_value)
            {
                $celsius = round($celsius);
            }
            
            $celsius_with_sign = $celsius . ' ' . self::$signs['celsius'];
        
            $data = array(
                'value' => $celsius,
                'sign'  => $celsius_with_sign,
            );
        
            return $data;
        }
        else
        {
            return FALSE;
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Fahrenheit to Kelvin conversion
    *
    * @param float $temp
    * @param Bool $round_value
    * 
    * @return mixed
    */
    public static function f_to_k($temp, $round_value=FALSE)
    {
        if(is_numeric($temp))
        {
            $kelvin = ($temp + 459.67) * (5 / 9);
        
            if($round_value)
            {
                $kelvin = round($kelvin);
            }
            
            $kelvin_with_sign = $kelvin . ' ' . self::$signs['kelvin'];
        
            $data = array(
                'value' => $kelvin,
                'sign'  => $kelvin_with_sign,
            );
        
            return $data;
        }
        else
        {
            return FALSE;
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Celsius to Fahrenheit conversion
    *
    * @param float $temp
    * @param Bool $round_value
    * 
    * @return mixed
    */
    public static function c_to_f($temp, $round_value=FALSE)
    {
        if(is_numeric($temp))
        {
            $fahrenheit = ($temp * (9 / 5)) + 32;
        
            if($round_value)
            {
                $fahrenheit = round($fahrenheit);
            }
            
            $fahrenheit_with_sign = $fahrenheit . ' ' . self::$signs['fahrenheit'];
        
            $data = array(
                'value' => $fahrenheit,
                'sign'  => $fahrenheit_with_sign,
            );
        
            return $data;
        }
        else
        {
            return FALSE;
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Celsius to Kelvin conversion
    *
    * @param float $temp
    * @param Bool $round_value
    * 
    * @return mixed
    */
    public static function c_to_k($temp, $round_value=FALSE)
    {
        if(is_numeric($temp))
        {
            $kelvin = $temp + self::$absolute_zero;
        
            if($round_value)
            {
                $kelvin = round($kelvin);
            }
            
            $kelvin_with_sign = $kelvin . ' ' . self::$signs['kelvin'];
        
            $data = array(
                'value' => $kelvin,
                'sign'  => $kelvin_with_sign,
            );
        
            return $data;
        }
        else
        {
            return FALSE;
        }
    }
    
    // -------------------------------------------------------------------------
}
?>