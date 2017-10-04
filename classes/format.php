<?php
/**
* Format methods
*/
class Format{
    public static $ip_locator           = 'http://www.infosniper.net/index.php?ip_address=';
    public static $ip_localhost_address = '::1';
    public static $ip_localhost_name    = 'Localhost';
    
    // -------------------------------------------------------------------------
    
    /**
    * Converts bytes to megabytes
    * 
    * @return Strubg $megabytes
    */
    public static function bytes_to_megabytes()
    {
        $base = log($size) / log(1024);             
        $f_base = floor($base);
        
        $megabytes = round(pow(1024, $base - floor($base)), 1) .' '. 'MB';
        
        return $megabytes;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Formating query
    * 
    * @param String $query
    * 
    * @return String $formated_query
    */
    public static function query($query)
    {
        $queryPrint = str_ireplace('<', '&lt;', $query);
        $queryPrint = str_ireplace('>', '&gt;', $queryPrint);
        
        $formated_query = '<pre><code>' . $queryPrint . '</code></pre>';
        
        return $formated_query;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Concatenates string
    * 
    * @param String $string
    * @param int $length
    * @param int $start
    * 
    * @return String $string
    */
    public static function string($string, $length, $start=0)
    {
        if(strlen($string) > $length)
        {
            $string = substr($string, $start, $length) . ' ...';
        }
        
        return $string;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Formats telephone number
    * 
    * @param String $telephone
    * @param String $telephone_backup
    * 
    * @return String $result
    */
    public static function telephone($telephone='', $telephone_backup='')
    {
        if(empty($telephone))
        {
            $telephone = $telephone_backup;
        }
        
        if(empty($telephone))
        {
            $result = '';
        }
        else
        {
            $exploded_telephone = explode(' ', $telephone);
            
            $telephone_print = '';
            foreach($exploded_telephone as $row)
            {
                $telephone = trim($row);
                $telephone = preg_replace('/[^0-9,.]/', '', $telephone);
                $telephone_print .= $telephone; 
            }        

            $first  = substr($telephone_print, 0, 3);
            $second = substr($telephone_print, 3, 2);
            $third  = substr($telephone_print, 5, 2);
            $fourth = substr($telephone_print, 7, 5);
            
            if(empty($exploded_telephone))
            {
                $result = 'N/A';                    
            }
            else
            {
                $result = $first . '/' . $second . '-' . $third . '-' . $fourth;
            }
        }
    
        return $result;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Formats website URL
    * 
    * @param String $location
    * @param Bool $name
    * 
    * @return String
    */
    public static function website($location, $name=FALSE)
    {
        $prefix_protocol = 'http://';
        $prefix_web      = 'www.';
        
        if(strpos($location, $prefix_web) !== FALSE)
        {
            $prefix = $prefix_protocol;
        }
        else
        {
            $prefix = $prefix_protocol . $prefix_web;   
        }
        
        $location_final = $prefix . $location;
        
        if($name)
        {
            return $location_final;
        }
        else
        {
            return ' ' . '<a href="' . $location_final . '" target="_blank">' . $location . '</a>' . ' ';
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Formats IP addres and creates URL to more information
    * 
    * @param String $ip
    * 
    * @return String
    */
    public static function ip($ip)
    {
        if($ip == self::$ip_localhost_address)
        {
            return self::$ip_localhost_name;
        }
        else
        {
            return '<a href="' . self::$ip_locator . $ip . '" target="_blank">' . $ip . '</a>';
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Formats email to mailto format
    * 
    * @param String $email
    * @param String $subject
    * 
    * @return String $formated_email
    */
    public static function email($email, $subject='')
    {
        if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $formated_email = '';
        }
        else
        {
            $formated_email = '<a href="mailto:' . $email . '?subject=' . $subject . '">' . $email . '</a>';
        }
        
        return $formated_email;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Reformats string to start with big first letter
    * 
    * @param String $title
    * 
    * @return String
    */
    public static function title_case($title)
    {
        return ucfirst(strtolower($title));
    }
    
    // -------------------------------------------------------------------------

    /**
    * Converting number to specific format
    * 
    * @param float $number
    * @param Bool $with_decimal
    * @param int $value
    * 
    * @return String $converted
    */
    public static function number($number, $with_decimal=TRUE, $value=1000000)
    {
        if(empty($number))
        {
            $converted = '';
        }
        else
        {
            if($with_decimal)
            {
                $converted = number_format($number/$value, 1, '.', '');
                if($converted < 1)
                {
                    $converted = substr($converted, 1, 2);
                }
            }
            else
            {
                $converted = number_format($number/$value, 0, '.', '');
            }
        }
        
        return $converted;
    }
    
    // -------------------------------------------------------------------------
}
?>