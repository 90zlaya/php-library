<?php
/**
* Random-related methods
*/
class Random{
    protected static $numbers      = '0123456789';
    protected static $alphanumeric = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    protected static $conso        = array("b","c","d","f","g","h","j","k","l","m","n","p","r","s","t","v","w","x","y","z");
    protected static $vocal        = array("a","e","i","o","u");
    
    // -------------------------------------------------------------------------    
    
    public static function generate_random($length=4, $type='INT'){
        switch($type){
            case 'INT':
            {
                $c = self::$numbers;
                $random_integer = NULL;
                
                for($i=0; $i<$length; $i++)
                {
                    $random_integer .= $c[rand()%strlen($c)];
                }
                
                $random_generated = $random_integer;
            } break;
            case 'STRING':
            {
                $c = self::$alphanumeric;
                $random_string = '';
                
                for($i=0; $i<$length; $i++)
                {
                    $random_string .= $c[rand()%strlen($c)];
                }
                
                $random_generated =  $random_string;
            } break;
            case 'STRING_ADVANCED':
            {
                $conso = self::$conso;
                $vocal = self::$vocal;
                $max = $length/2;           
                $readable_random_string = '';
                
                for($i=1; $i<=$max; $i++)
                {
                    if($i == 1)
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
                
                $random_generated = $readable_random_string;
            } break;
        }
        
        return $random_generated;
    }
    
    // -------------------------------------------------------------------------
}
?>    