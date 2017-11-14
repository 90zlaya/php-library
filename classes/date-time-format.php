<?php 
/*
| -------------------------------------------------------------------
| DATE TIME FORMAT
| -------------------------------------------------------------------
|
| Date and Time formating, validating, comparing, converting...
|
| -------------------------------------------------------------------
*/
namespace phplibrary;

class Date_Time_Format{
    public static $types = array(
        'user'     => array(
            'format'      => 'd.m.Y',
            'placeholder' => 'DD.MM.YYYY',
            'regex'       => '^([0-9]{2})\.([0-9]{2})\.([0-9]{4})$^',
        ),
        'database' => array(
            'format'      => 'Y-m-d',
            'placeholder' => 'YYYY-MM-DD',
            'regex'       => '^([0-9]{4})-([0-9]{2})-([0-9]{2})$^',
        ),
        'friendly' => array(
            'date'     => 'd-M-Y',
            'datetime' => 'd-M-Y H:i:s',
        ),
        'unfriendly' => array(
            'date'     => 'Ymd',
            'datetime' => 'YmdHis',
        ),
    );
    
    protected static $invalid_dates = array('1970-01-01', '0000-00-00');
    
    // -------------------------------------------------------------------------
    
    /**
    * Returns current date-time of given format
    * 
    * @param String $format
    * 
    * @return String
    */
    public static function current($format='')
    {
        if(empty($format))
        {
            $format = self::$types['unfriendly']['datetime'];
        }
        
        return date($format);
    }

    // -------------------------------------------------------------------------
    
    /**
    * Compares given date with current date
    * 
    * @param String $date
    * 
    * @return Bool
    */
    public static function compare($date)
    {
        if(self::current(self::$types['database']['format']) > date(self::$types['database']['format'], strtotime($date)))
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
    * Formats date to friendly format with or without time
    * 
    * @param String $date
    * @param Bool $without_time
    * 
    * @return String
    */
    public static function format($date, $without_time=FALSE)
    {
        if($without_time)
        {
            return date(self::$types['friendly']['date'], strtotime($date));
        }
        else
        {
            return date(self::$types['friendly']['datetime'], strtotime($date));
        }
    } 
    
    // -------------------------------------------------------------------------
    
    /**
    * Formats date to database-friendly format
    * 
    * @param String $date
    * 
    * @return mixed
    */
    public static function format_to_database($date)
    {
        $format_to_database = date(self::$types['database']['format'], strtotime($date));
        
        if(self::validate($date, self::$types['user']['placeholder']) && self::not_empty($format_to_database))
        {
            return $format_to_database;
        }
        else
        {
            return FALSE;
        }
    } 
    
    // -------------------------------------------------------------------------
    
    /**
    * Formats date to user-friendly format
    * 
    * @param String $date
    * 
    * @return String
    */
    public static function format_to_user($date)
    {
        $format_to_user = date(self::$types['user']['format'], strtotime($date));
        
        if(self::validate($date, self::$types['database']['placeholder']) && self::not_empty($format_to_user))
        {
            return $format_to_user;
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
    * 
    * @return Bool
    */
    protected static function validate($date, $format)
    {
        switch($format)
        {
            case self::$types['user']['placeholder']:
                {
                    $regex = self::$types['user']['regex'];
                } break;
            case self::$types['database']['placeholder']:
                {
                    $regex = self::$types['database']['regex'];
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
    * Checking if given date is considered as not empty
    * 
    * @param String $date
    * 
    * @return Bool
    */
    protected static function not_empty($date)
    {
        if(empty($date) || in_array($date, self::$invalid_dates))
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Converts minutes to hours
    * 
    * @param int $time
    * @param String $format
    * 
    * @return Bool
    */
    public static function minutes_to_hours($time=0, $format='%02d:%02d')
    {
        if(is_int($time))
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
        else
        {
            return FALSE;
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Converts hours to minutes
    * 
    * @param String $time
    * 
    * @return String $minutes
    */
    public static function hours_to_minutes($time)
    {
        if(strpos($time, ':') !== FALSE)
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
        }
        else
        {
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
    * 
    * @return mixed
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
    
    /**
    * Adds date-time prefix to given string
    * 
    * @param String $string
    * 
    * @return mixed
    */
    public static function prefix($string)
    {
        if(empty($string))
        {
            return FALSE;
        }
        else
        {
            $date_time = date(self::$types['unfriendly']['datetime']);
            $string_with_prefix = $date_time . '_' . $string;
            
            return $string_with_prefix;
        }
    }
    
    // -------------------------------------------------------------------------

    /**
    * Format JMBG to date
    * 
    * @param String $jmbg
    * 
    * @return mixed $date
    */
    public static function date_from_jmbg($jmbg)
    {
        if(empty($jmbg) || strlen($jmbg) < 13)
        {
            $date = FALSE;
        }
        else
        {
            $date_day   = substr($jmbg, 0, 2);
            $date_month = substr($jmbg, 2, 2);
            $date_year  = substr($jmbg, 4, 3);
            
            if(substr($date_day, 0, 1) == 0)
            {
                $date_day = substr($date_day, 1, 2); 
            }
            
            if(substr($date_month, 0, 1) == 0)
            {
                $date_month = substr($date_month, 1, 2); 
            }

            if($date_year > 100)
            {
                $date_year = 1 . $date_year;
            }
            else
            {
                $date_year = 2 . $date_year;    
            }
            
            $date = $date_day . '. ' . $date_month . '. ' . $date_year . '.';
        }
            
        return $date;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Name of the first day in year
    * 
    * @param String $format
    * @param int $year
    * 
    * @return String $january_first
    */
    public static function first_day_of_year($format='l', $year=0)
    {
        $first_day_and_month = '01.01.';
        
        if(empty($year))
        {
            $year  = date('Y');
        }
        
        switch($format)
        {
            case 'd': $january_first = date($format, strtotime($first_day_and_month . $year)); break;
            case 'D': $january_first = date($format, strtotime($first_day_and_month . $year)); break;
            case 'j': $january_first = date($format, strtotime($first_day_and_month . $year)); break;
            case 'l': $january_first = date($format, strtotime($first_day_and_month . $year)); break;
            case 'N': $january_first = date($format, strtotime($first_day_and_month . $year)); break;
            case 'S': $january_first = date($format, strtotime($first_day_and_month . $year)); break;
            case 'z': $january_first = date($format, strtotime($first_day_and_month . $year)); break;
        }
        
        return $january_first;
    }
    
    // -------------------------------------------------------------------------
}
?>