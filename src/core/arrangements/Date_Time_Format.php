<?php
/**
* Date_Time_Format
*
* Date and Time formating, validating, comparing, converting...
*
* @package      PHP_Library
* @subpackage   Core
* @category     Arrangements
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace PHP_Library\Core\Arrangements;

/**
* Date and Time formating, validating, comparing, converting...
*/
class Date_Time_Format {

    // -------------------------------------------------------------------------

    /**
    * Date and time types
    *
    * @var array
    */
    public static $types = array(
        'user'       => array(
            'format'      => 'd.m.Y',
            'placeholder' => 'DD.MM.YYYY',
            'regex'       => '^([0-9]{2})\.([0-9]{2})\.([0-9]{4})$^',
        ),
        'database'   => array(
            'format'      => 'Y-m-d',
            'placeholder' => 'YYYY-MM-DD',
            'regex'       => '^([0-9]{4})-([0-9]{2})-([0-9]{2})$^',
        ),
        'friendly'   => array(
            'date'     => 'd-M-Y',
            'datetime' => 'd-M-Y H:i:s',
        ),
        'unfriendly' => array(
            'date'     => 'Ymd',
            'datetime' => 'YmdHis',
        ),
    );

    // -------------------------------------------------------------------------

    /**
    * Days in week divided by languages
    *
    * @var array
    */
    private static $days = array(
        'english' => array(
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
        ),
        'serbian' => array(
            'Nedelja',
            'Ponedeljak',
            'Utorak',
            'Sreda',
            'Četvrtak',
            'Petak',
            'Subota',
        ),
    );

    // -------------------------------------------------------------------------

    /**
    * Months in year divided by languages
    *
    * @var array
    */
    private static $months = array(
        'english' => array(
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
        ),
        'serbian' => array(
            'Januar',
            'Februar',
            'Mart',
            'April',
            'Maj',
            'Jun',
            'Jul',
            'Avgust',
            'Septembar',
            'Oktobar',
            'Novembar',
            'Decembar',
        ),
    );

    // -------------------------------------------------------------------------

    /**
    * Invalid dates for database insertion
    *
    * @var array
    */
    private static $invalid_dates = array(
        '01.01.1970',
        '1970-01-01',
        '0000-00-00',
    );

    // -------------------------------------------------------------------------

    /**
    * Returns current date-time of given format
    *
    * @param string $format
    *
    * @return string
    */
    public static function current($format='')
    {
        empty($format)
            ? $format = self::$types['unfriendly']['datetime']
            : NULL;

        return date($format);
    }

    // -------------------------------------------------------------------------

    /**
    * Compares given date with current date
    *
    * @param string $date
    *
    * @return bool
    */
    public static function compare($date)
    {
        return self::current(self::$types['database']['format']) >
            date(self::$types['database']['format'], (int) strtotime($date));
    }

    // -------------------------------------------------------------------------

    /**
    * Formats date to friendly format with or without time
    *
    * @param string $date
    * @param bool $without_time
    *
    * @return string
    */
    public static function format($date, $without_time=FALSE)
    {
        $type = $without_time
            ? self::$types['friendly']['date']
            : self::$types['friendly']['datetime'];

        return date($type, (int) strtotime($date));
    }

    // -------------------------------------------------------------------------

    /**
    * Formats date to database-friendly format
    *
    * @param string $date
    *
    * @return mixed
    */
    public static function format_to_database($date)
    {
        if (self::not_empty($date))
        {
            $format_to_database = date(
                self::$types['database']['format'],
                (int) strtotime($date)
            );

            return $format_to_database;
        }

        return FALSE;
    }

    // -------------------------------------------------------------------------

    /**
    * Formats date to user-friendly format
    *
    * @param string $date
    *
    * @return mixed
    */
    public static function format_to_user($date)
    {
        if (self::not_empty($date))
        {
            $format_to_user = date(
                self::$types['user']['format'],
                (int) strtotime($date)
            );

            return $format_to_user;
        }

        return FALSE;
    }

    // -------------------------------------------------------------------------

    /**
    * Checking if given date is considered as not empty
    *
    * @param string $date
    *
    * @return bool
    */
    private static function not_empty($date)
    {
        if (empty($date) || in_array($date, self::$invalid_dates))
        {
            return FALSE;
        }

        return TRUE;
    }

    // -------------------------------------------------------------------------

    /**
    * Converts minutes to hours
    *
    * @param int $time
    * @param string $format
    *
    * @return mixed
    */
    public static function minutes_to_hours($time=0, $format='%02d:%02d')
    {
        if (is_int($time))
        {
            if ($time > 0)
            {
                $hours   = floor($time / 60);
                $minutes = ($time % 60);

                return sprintf($format, $hours, $minutes);
            }
            else
            {
                return '00:00';
            }
        }

        return FALSE;
    }

    // -------------------------------------------------------------------------

    /**
    * Converts hours to minutes
    *
    * @param string $time
    *
    * @return int $minutes
    */
    public static function hours_to_minutes($time)
    {
        $minutes = 0;

        if (strpos($time, ':') !== FALSE)
        {
            $exploded = explode(':', $time);

            $hours = $minutes = 0;

            $hours_first = TRUE;

            foreach ($exploded as $row)
            {
                $number = $row;

                if ($hours_first)
                {
                    $hours = $number;

                    $hours_first = FALSE;
                }
                else
                {
                    $minutes = $number;
                }
            }

            $hours_to_minutes = (int) $hours * 60;
            $minutes          = $hours_to_minutes + (int) $minutes;
        }

        return $minutes;
    }

    // -------------------------------------------------------------------------

    /**
    * Converts number of day to day name for given language
    *
    * @param int $day
    * @param string $language
    * @param bool $lowercase
    *
    * @return mixed
    */
    public static function number_to_day($day, $language='', $lowercase=TRUE)
    {
        if ($day >= 1 && $day <= 7)
        {
            empty($language) ? $language = 'serbian' : NULL;

            $day = self::get_days($language, 0, FALSE)['php'][$day-1];

            return $lowercase ? strtolower($day) : $day;
        }

        return FALSE;
    }

    // -------------------------------------------------------------------------

    /**
    * Converts number of month to month name for given language
    *
    * @param int $month
    * @param string $language
    * @param bool $lowercase
    *
    * @return mixed
    */
    public static function number_to_month($month, $language='', $lowercase=TRUE)
    {
        if ($month >= 1 && $month <= 12)
        {
            empty($language) ? $language = 'serbian' : NULL;

            $month = self::get_months($language)['php'][$month-1];

            return $lowercase ? strtolower($month) : $month;
        }

        return FALSE;
    }

    // -------------------------------------------------------------------------

    /**
    * Adds date-time prefix to given string
    *
    * @param string $string
    *
    * @return mixed
    */
    public static function prefix($string)
    {
        if ( ! empty($string))
        {
            return date(self::$types['unfriendly']['datetime']) . '_' . $string;
        }

        return FALSE;
    }

    // -------------------------------------------------------------------------

    /**
    * Format JMBG to date
    *
    * @param string $jmbg
    *
    * @return mixed
    */
    public static function date_from_jmbg($jmbg)
    {
        if (strlen($jmbg) === 13)
        {
            $date_day   = substr($jmbg, 0, 2);
            $date_month = substr($jmbg, 2, 2);
            $date_year  = substr($jmbg, 4, 3);

            substr($date_day, 0, 1) == 0
                ? $date_day = substr($date_day, 1, 2)
                : NULL;

            substr($date_month, 0, 1) == 0
                ? $date_month = substr($date_month, 1, 2)
                : NULL;

            $number_year = $date_year > 100 ? 1 : 2;

            return $date_day .
                '. ' .
                $date_month .
                '. ' .
                $number_year .
                $date_year .
                '.';
        }

        return FALSE;
    }

    // -------------------------------------------------------------------------

    /**
    * Name of the first day in year for given format
    *
    * @param string $format
    * @param int $year
    *
    * @return mixed
    */
    public static function first_day_of_year($format='l', $year=0)
    {
        if (in_array($format, array('d', 'D', 'j', 'l', 'N', 'S', 'z')))
        {
            empty($year) ? $year = date('Y') : NULL;

            return date($format, (int) strtotime('01.01.' . $year));
        }

        return FALSE;
    }

    // -------------------------------------------------------------------------

    /**
    * Date before certain number of days
    *
    * @param int $number_of_days
    * @param string $format
    *
    * @return mixed
    */
    public static function days_before($number_of_days, $format='')
    {
        if ( ! empty($number_of_days))
        {
            empty($format)
                ? $format = self::$types['database']['format']
                : NULL;

            return date($format, (int) strtotime(' -' . $number_of_days . ' day'));
        }

        return FALSE;
    }

    // -------------------------------------------------------------------------

    /**
    * Date after certain number of days
    *
    * @param int $number_of_days
    * @param string $format
    *
    * @return mixed
    */
    public static function days_after($number_of_days, $format='')
    {
        if ( ! empty($number_of_days))
        {
            empty($format)
                ? $format = self::$types['database']['format']
                : NULL;

            return date($format, (int) strtotime(' +' . $number_of_days . ' day'));
        }

        return FALSE;
    }

    // -------------------------------------------------------------------------

    /**
    * Get list of days
    *
    * @param string $lang
    * @param int $length
    * @param bool $sunday_first
    *
    * @return array
    */
    public static function get_days($lang='', $length=0, $sunday_first=TRUE)
    {
        $days = isset(self::$days[$lang])
            ? self::$days[$lang]
            : self::$days['english'];

        if ( ! empty($length))
        {
            $days_short = array();

            foreach ($days as $item)
            {
                $days_short[] = substr($item, 0, $length);
            }

            $days = &$days_short;
        }

        if ( ! $sunday_first)
        {
            $days = array_merge(
                array_slice($days, 1),
                array($days[0])
            );
        }

        return array(
            'php'  => $days,
            'json' => json_encode($days),
        );
    }

    // -------------------------------------------------------------------------

    /**
    * Get list of months
    *
    * @param string $lang
    * @param int $length
    *
    * @return array
    */
    public static function get_months($lang='', $length=0)
    {
        $months = isset(self::$months[$lang])
            ? self::$months[$lang]
            : self::$months['english'];

        if ( ! empty($length))
        {
            $months_short = array();

            foreach ($months as $item)
            {
                $months_short[] = substr($item, 0, $length);
            }

            $months = &$months_short;
        }

        return array(
            'php'  => $months,
            'json' => json_encode($months),
        );
    }

    // -------------------------------------------------------------------------
}
