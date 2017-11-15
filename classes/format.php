<?php
/*
| -------------------------------------------------------------------
| FORMAT
| -------------------------------------------------------------------
|
| Format related methods
|
| -------------------------------------------------------------------
*/
namespace phplibrary;

class Format {
    protected static $utf_8         = 'utf-8';
    protected static $windows_1250  = 'windows-1250';
    protected static $ip            = array(
        'locator'   => 'http://www.geoplugin.net/php.gp?ip=',
        'localhost' => array(
            'name'      => 'Localhost',
            'addresses' => array(
                '::1', 
                '127.0.0.1'
            ),
        ),
    );
    protected static $website       = array(
        'regex'     => '/^(http(s?):\/\/)?[a-zA-Z0-9\.\-\_]+(\.[a-zA-Z]{2,3})+(\/[a-zA-Z0-9\_\-\s\.\/\?\%\#\&\=]*)?$/',
        'web'       => 'www',
        'protocol'  => array(
            'unsafe' => 'http://',
            'safe'   => 'https://',
        ),
    );
    protected static $units         = array(
        'B', 
        'kB', 
        'MB', 
        'GB', 
        'TB'
    );
    
    // -------------------------------------------------------------------------
    
    /**
    * Converts bytes
    * 
    * @param int $bytes
    * @param Bool $to_round
    * @param int $round_precision
    * 
    * @return Array
    */
    public static function bytes($bytes, $to_round=TRUE, $round_precision=2)
    {
        $bytes = max($bytes, 0); 
        $pow   = floor(($bytes ? log($bytes) : 0) / log(1024)); 
        $pow   = min($pow, count(self::$units) - 1);
        $bytes = $bytes / pow(1024, $pow);
        
        $to_round ? $bytes = round($bytes, $round_precision) : NULL;
        
        return array(
            'value' => $bytes,
            'sign'  => $bytes . ' ' . self::$units[$pow],
        );
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Formating query
    * 
    * @param String $query
    * 
    * @return String
    */
    public static function query($query)
    {
        $query = str_ireplace('<', '&lt;', $query);
        $query = str_ireplace('>', '&gt;', $query);
        
        return '<pre><code>' . $query . '</code></pre>';
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Formats telephone number
    * 
    * @param String $telephone
    * @param String $telephone_backup
    * 
    * @return mixed
    */
    public static function telephone($telephone='', $telephone_backup='')
    {
        if (empty($telephone))
        {
            $telephone = $telephone_backup;
        }
        
        $exploded_telephone = explode(' ', $telephone);
            
        if (!empty($exploded_telephone))
        {
            $telephone_print = '';
            
            foreach ($exploded_telephone as $row)
            {
                $telephone = trim($row);
                $telephone = preg_replace('/[^0-9,.]/', '', $telephone);
                $telephone_print .= $telephone; 
            }        

            $first  = substr($telephone_print, 0, 3);
            $second = substr($telephone_print, 3, 2);
            $third  = substr($telephone_print, 5, 2);
            $fourth = substr($telephone_print, 7, 5);
        
            return $first . '/' . $second . '-' . $third . '-' . $fourth;
        }
        
        return FALSE;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Formats website URL
    * 
    * @param String $location
    * 
    * @return mixed
    */
    public static function website($location)
    {
        if (preg_match(self::$website['regex'], $location))
        {
            if (strpos($location, self::$website['protocol']['safe']) !== FALSE || strpos($location, self::$website['protocol']['unsafe']) !== FALSE)
            {
                $location_final = $location;
            }
            else if (strpos($location, self::$website['web']) !== FALSE)
            {
                $prefix = self::$website['protocol']['unsafe'];
                $location_final = $prefix . $location;
            }
            else
            {
                $prefix = self::$website['protocol']['unsafe'] . self::$website['web'] . '.';
                $location_final = $prefix . $location;
            }
                         
            return array(
                'name'      => $location_final,
                'anchor'    => '<a href="' . $location_final . '" target="_blank">' . $location . '</a>',
            );
        }
        
        return FALSE;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Formats IP addres and creates URL to more information
    * 
    * @param String $ip
    * 
    * @return String $converted
    */
    public static function ip($ip)
    {
        if (in_array($ip, self::$ip['localhost']['addresses']))
        {
            $converted = self::$ip['localhost']['name'];
        }
        else
        {
            $converted = '<a href="' . self::$ip['locator'] . $ip . '" target="_blank">' . $ip . '</a>';
        }
        
        return $converted;
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
        if (empty($number))
        {
            $converted = '';
        }
        else
        {
            if ($with_decimal)
            {
                $converted = number_format($number/$value, 1, '.', '');
                if ($converted < 1)
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

    /**
    * Convert given data to readable format
    * 
    * @param mixed $data
    * @param Bool $to_print
    * 
    * @return mixed
    */
    public static function pre($data, $to_print=TRUE)
    {
        if ($to_print)
        {
            print_r('<pre>');
            print_r($data);
            print_r('</pre>');
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Converting string from Windows-1250 to UTF-8
    * 
    * @param String $string
    * 
    * @return String
    */
    public static function windows1250_to_utf8($string)
    {
        return iconv(self::$windows_1250, self::$utf_8, $string);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Converting string from UTF-8 to Windows-1250
    * 
    * @param String $string
    * 
    * @return String $converted
    */
    public static function utf8_to_windows1250($string)
    {
        return iconv(self::$utf_8, self::$windows_1250, $string);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Formating shortened string
    * 
    * @param String $string
    * @param int $start
    * @param int $length
    * 
    * @return String $corrected
    */
    public static function string($string, $start=0, $length=15)
    {
        $string = strip_tags($string);
        $string_length = strlen($string);
        
        if ($string_length > $length)
        {
            $corrected = mb_substr($string, $start, $length) . '...';
        }
        else
        {
            $corrected = $string;    
        }
        
        return $corrected;    
    }
    
    // -------------------------------------------------------------------------
}
?>