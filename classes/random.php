<?php
/*
| -------------------------------------------------------------------
| RANDOM
| -------------------------------------------------------------------
|
| Random-related data
|
| -------------------------------------------------------------------
*/
namespace phplibrary;

class Random {
    protected static $numbers      = '0123456789';
    protected static $alphanumeric = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    protected static $consonant    = array("b","c","d","f","g","h","j","k","l","m","n","p","r","s","t","v","w","x","y","z");
    protected static $vocal        = array("a","e","i","o","u");
    
    // -------------------------------------------------------------------------    
    
    /**
    * Generates random sequence for given length and sequence type
    * 
    * @param int $length
    * @param String $type
    * 
    * @return String $random_generated
    */
    public static function generate($length=4, $type='INT')
    {
        switch ($type)
        {
            case 'INT':
                {
                    $c = self::$numbers;
                    $random_integer = NULL;
                    
                    for ($i=0; $i<$length; $i++)
                    {
                        $random_integer .= $c[rand()%strlen($c)];
                    }
                    
                    return $random_integer;
                }
            case 'STRING':
                {
                    $c = self::$alphanumeric;
                    $random_string = '';
                    
                    for ($i=0; $i<$length; $i++)
                    {
                        $random_string .= $c[rand()%strlen($c)];
                    }
                    
                    return $random_string;
                }
            case 'STRING_ADVANCED':
                {
                    $conso = self::$consonant;
                    $vocal = self::$vocal;
                    $max = $length/2;           
                    $readable_random_string = '';
                    
                    for ($i=1; $i<=$max; $i++)
                    {
                        if ($i == 1)
                        {
                            $readable_random_string .= strtoupper($conso[rand(0,19)]);
                            $readable_random_string .= $vocal[rand(0,4)]; ;
                        }
                        else
                        {
                            $readable_random_string .= $conso[rand(0,19)];
                            $readable_random_string .= $vocal[rand(0,4)];
                        }
                    }
                    
                    return $readable_random_string;
                }
            default: return FALSE;
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Returns random element of array for given dose
    * 
    * @param Array $list
    * @param String $dose
    * 
    * @return Array $element
    */
    public static function element($list, $dose='')
    {
        $list_size = sizeof($list);
        
        ($dose === 'DAY' && $list_size < 7) || ($dose === 'MONTH' && $list_size < 31) ? $dose = '' : NULL;
        
        switch ($dose)
        {
            case 'DAY': $index = date('N') - 1; break;
            case 'MONTH': $index = date('j') - 1; break;
            default: $index = rand(0, $list_size - 1);
        }
        
        return $list[$index];
    }
    
    // -------------------------------------------------------------------------
}
?>    