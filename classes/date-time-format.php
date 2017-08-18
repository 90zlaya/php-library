<?php
/**
* Date and Time formating, validating, comparing, converting...
*/
class Date_Time_Format{
    public static $user     = 'd.m.Y';
    public static $database = 'Y-m-d';
    
    public static $user_placeholder     = 'DD.MM.YYYY';
    public static $database_placeholder = 'YYYY.MM.DD';
    
    public static $friendly_date     = 'd-M-Y';
    public static $friendly_datetime = 'd-M-Y H:i:s';
    
    // -------------------------------------------------------------------------
    
    /**
    * Returns current date-time of given format
    * 
    * @param mixed $format
    */
    public static function current($format='YmdHis')
    {
        return date($format);
    }

    // -------------------------------------------------------------------------
    
    /**
    * Compares given date with current date
    * 
    * @param String $date
    */
    public static function compare($date)
    {
        if(self::current(self::$database) > date(self::$database, strtotime($date)))
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
    * Validates date to certain format type
    * 
    * @param String $date
    * @param String $format
    */
    public static function validate($date, $format)
    {
        switch($format)
        {
            case self::$user_placeholder:
                {
                    $regex = '^([0-9]{2})\.([0-9]{2})\.([0-9]{4})$^';
                } break;
            case self::$database_placeholder:
                {
                    $regex = '^([0-9]{4})-([0-9]{2})-([0-9]{2})$^';
                } break;
            default: $regex = '';
        }
        
        if(empty($regex))
        {
            return FALSE;
        }
        else
        {
            if(preg_match($regex, $date))
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Formats date to friendly format with or without time
    * 
    * @param String $date
    * @param Bool $without_time
    */
    public static function format($date, $without_time=FALSE)
    {
        if($without_time)
        {
            return date(self::$friendly_date, strtotime($date));
        }
        else
        {
            return date(self::$friendly_datetime, strtotime($date));
        }
    } 
    
    // -------------------------------------------------------------------------
    
    /**
    * Formats date to database-friendly format
    * 
    * @param String $date
    */
    public static function format_to_database($date)
    {
        return date(self::$database, strtotime($date));
    } 
    
    // -------------------------------------------------------------------------
    
    /**
    * Formats date to user-friendly format
    * 
    * @param String $date
    */
    public static function format_to_user($date)
    {
        return date(self::$user, strtotime($date));
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Converts minutes to hours
    * 
    * @param int $time
    * @param String $format
    * @return String
    */
    public static function minutes_to_hours($time=0, $format='%02d:%02d')
    {
        if($time > 0)
        {
            $hours = floor($time / 60);
            $minutes = ($time % 60);
            
            return sprintf($format, $hours, $minutes);
        }
        else
        {
            return '00:00';
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Converts hours to minutes
    * 
    * @param String $time
    */
    public static function hours_to_minutes($time)
    {
        if (strpos($time, ':') !== FALSE)
        {
            $exploded = explode(':', $time);
          
            $hours_first = TRUE;
            foreach($exploded as $row)
            {
                  $number = $row;
                        
                  if($hours_first)
                  {
                      $hours = $number; 
                      $hours_first = FALSE;
                  }
                  else
                  {
                      $minutes = $number; 
                  }                           
            }               
            $minutes += $hours * 60;
        }else{
            $minutes = '';  
        }
    return $minutes; 
    } 
    
    // -------------------------------------------------------------------------
    
    /**
    * Converts number of month to month name in specific language
    * 
    * @param int $month
    * @param String $language
    * @return String/Bool
    */
    public static function number_to_month($month, $language='')
    {
        switch($month)
        {
            case 1:
                {
                    switch($language)
                    {
                        case 'EN': return 'january'; break;
                        default: return 'januar';
                    }
                } break;
            case 2:
                {
                    switch($language)
                    {
                        case 'EN': return 'february'; break;
                        default: return 'februar';
                    }
                } break;
            case 3:
                {
                    switch($language)
                    {
                        case 'EN': return 'march'; break;
                        default: return 'mart';
                    }
                } break;
            case 4:
                {
                    switch($language)
                    {
                        case 'EN': return 'april'; break;
                        default: return 'april';
                    }
                } break;
            case 5:
                {
                    switch($language)
                    {
                        case 'EN': return 'may'; break;
                        default: return 'maj';
                    }
                } break;
            case 6:
                {
                    switch($language)
                    {
                        case 'EN': return 'june'; break;
                        default: return 'jun';
                    }
                } break;
            case 7:
                {
                    switch($language)
                    {
                        case 'EN': return 'july'; break;
                        default: return 'jul';
                    }
                } break;
            case 8:
                {
                    switch($language)
                    {
                        case 'EN': return 'august'; break;
                        default: return 'avgust';
                    }
                } break;
            case 9:
                {
                    switch($language)
                    {
                        case 'EN': return 'september'; break;
                        default: return 'septembar';
                    }
                } break;
            case 10:
                {
                    switch($language)
                    {
                        case 'EN': return 'october'; break;
                        default: return 'oktobar';
                    }
                } break;
            case 11:
                {
                    switch($language)
                    {
                        case 'EN': return 'november'; break;
                        default: return 'novembar';
                    }
                } break;
            case 12:
                {
                    switch($language)
                    {
                        case 'EN': return 'december'; break;
                        default: return 'decembar';
                    }
                } break;
            default: return FALSE;
        }
    }
    
    // -------------------------------------------------------------------------
}
?>