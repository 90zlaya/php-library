<?php
/**
* Format
*
* Format related methods
*
* @package      PHP_Library
* @subpackage   Core
* @category     Arrangements
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace PHP_Library\Core\Arrangements;

/**
* Format related methods
*/
class Format {

    /* ---------------------------------------------------------------------- */

    /**
    * UTF-8 value
    *
    * @var string
    */
    private static $utf_8 = 'utf-8';

    /* ---------------------------------------------------------------------- */

    /**
    * Windows-1250 value
    *
    * @var string
    */
    private static $windows_1250 = 'windows-1250';

    /* ---------------------------------------------------------------------- */

    /**
    * IP related values
    *
    * @var array
    */
    private static $ip = array(
        'locator'   => 'http://www.geoplugin.net/php.gp?ip=',
        'localhost' => array(
            'name'      => 'Localhost',
            'addresses' => array(
                '::1',
                '127.0.0.1',
            ),
        ),
    );

    /* ---------------------------------------------------------------------- */

    /**
    * Website related values
    *
    * @var array
    */
    private static $website = array(
        'regex'    => '/^(http(s?):\/\/)?[a-zA-Z0-9\.\-\_]+(\.[a-zA-Z]{2,3})+(\/[a-zA-Z0-9\_\-\s\.\/\?\%\#\&\=]*)?$/',
        'web'      => 'www',
        'protocol' => array(
            'unsafe' => 'http://',
            'safe'   => 'https://',
        ),
    );

    /* ---------------------------------------------------------------------- */

    /**
    * Computer digital information units
    *
    * @var array
    */
    private static $units = array(
        'B',
        'kB',
        'MB',
        'GB',
        'TB',
    );

    /* ---------------------------------------------------------------------- */

    /**
    * Converts bytes
    *
    * @param int $bytes
    * @param bool $to_round
    * @param int $round_precision
    *
    * @return array
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

    /* ---------------------------------------------------------------------- */

    /**
    * Formating query
    *
    * @param string $query
    *
    * @return string
    */
    public static function query($query)
    {
        $query = str_ireplace('<', '&lt;', $query);
        $query = str_ireplace('>', '&gt;', $query);

        return '<pre><code>' . $query . '</code></pre>';
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Formats telephone number
    *
    * @param string $telephone
    * @param string $telephone_backup
    *
    * @return mixed
    */
    public static function telephone($telephone='', $telephone_backup='')
    {
        if (empty($telephone))
        {
            $telephone = $telephone_backup;
        }

        if ( ! empty($telephone))
        {
            $telephone_print    = '';
            $exploded_telephone = explode(' ', $telephone);

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

    /* ---------------------------------------------------------------------- */

    /**
    * Formats website URL
    *
    * @param string $location
    * @param bool $is_ssl
    *
    * @return mixed
    */
    public static function website($location, $is_ssl=FALSE)
    {
        if (preg_match(self::$website['regex'], $location))
        {
            if
            (
                strpos($location, self::$website['protocol']['safe']) !== FALSE ||
                strpos($location, self::$website['protocol']['unsafe']) !== FALSE)
            {
                $location_final = $location;
            }
            elseif (strpos($location, self::$website['web']) !== FALSE)
            {
                $prefix = self::$website['protocol']['unsafe'];

                $location_final = $prefix . $location;
            }
            else
            {
                $prefix = $is_ssl
                    ? self::$website['protocol']['safe']
                    : self::$website['protocol']['unsafe'];

                $prefix .= self::$website['web'] . '.';

                $location_final = $prefix . $location;
            }

            $anchor  = '<a href="';
            $anchor .= $location_final;
            $anchor .= '" target="_blank" rel="noopener">';
            $anchor .= $location;
            $anchor .= '</a>';

            return array(
                'name'   => $location_final,
                'anchor' => $anchor,
            );
        }

        return FALSE;
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Formats IP addres and creates URL to more information
    *
    * @param string $ip
    *
    * @return mixed
    */
    public static function ip($ip)
    {
        if ( ! empty($ip))
        {
            if (in_array($ip, self::$ip['localhost']['addresses']))
            {
                return self::$ip['localhost']['name'];
            }
            else
            {
                return '<a href="' .
                    self::$ip['locator'] .
                    $ip .
                    '" target="_blank" rel="noopener">' .
                    $ip .
                    '</a>';
            }
        }

        return FALSE;
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Reformats string to start with big first letter
    *
    * @param string $title
    *
    * @return string
    */
    public static function title_case($title)
    {
        return ucfirst(strtolower($title));
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Converting number to specific format
    *
    * @param float $number
    * @param bool $with_decimal
    * @param int $value
    *
    * @return string $converted
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

    /* ---------------------------------------------------------------------- */

    /**
    * Convert given data to readable format
    *
    * @param mixed $data
    * @param bool $to_print
    *
    * @return void
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

    /* ---------------------------------------------------------------------- */

    /**
    * Converting string from Windows-1250 to UTF-8
    *
    * @param string $string
    *
    * @return mixed
    */
    public static function windows1250_to_utf8($string)
    {
        return iconv(self::$windows_1250, self::$utf_8, trim($string));
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Converting string from UTF-8 to Windows-1250
    *
    * @param string $string
    *
    * @return mixed
    */
    public static function utf8_to_windows1250($string)
    {
        return iconv(self::$utf_8, self::$windows_1250, trim($string));
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Formating shortened string
    *
    * @param string $string
    * @param int $start
    * @param int $length
    *
    * @return string $corrected
    */
    public static function string($string, $start=0, $length=15)
    {
        $string        = strip_tags($string);
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

    /* ---------------------------------------------------------------------- */

    /**
    * Formats price for user
    *
    * @param float $price
    * @param int $decimal
    *
    * @return mixed
    */
    public static function price_format($price, $decimal=2)
    {
        if (stripos( (string) $price, ',') === FALSE)
        {
            $price_format = number_format($price, $decimal);
            $price_format = str_replace('.', '?', $price_format);
            $price_format = str_replace(',', '.', $price_format);
            $price_format = str_replace('?', ',', $price_format);

            return $price_format;
        }

        return FALSE;
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Formats array to string
    *
    * @param array $array
    * @param string $separator
    *
    * @return string
    */
    public static function array_to_string($array, $separator='|')
    {
        $string = '';

        if ( ! empty($array) && is_array($array))
        {
            $array_size = count($array);

            for ($i=0; $i<$array_size; $i++)
            {
                $string .= $array[$i];

                if ($i < $array_size-1)
                {
                    $string .= $separator;
                }
            }
        }

        return $string;
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Formats name and surname to one string
    *
    * @param string $name
    * @param string $surname
    * @param string $delimiter
    *
    * @return string
    */
    public static function fullname($name, $surname, $delimiter=' ')
    {
        return $name . $delimiter . $surname;
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Advanced database search
    *
    * @param string $term
    * @param array $fields
    *
    * @return mixed
    */
    public static function search_wizard($term, $fields)
    {
        if ( ! empty($term) && ! empty($fields))
        {
            $term_counter = $field_counter = TRUE;
            $term_array   = explode(' ', $term);

            $html = " AND ( ";

            foreach ($term_array as $term_item)
            {
                if ($term_counter)
                {
                    $term_counter = FALSE;

                    $html .= " ( ";
                }
                else
                {
                    $html .= ' AND ( ';
                }

                $field_counter = TRUE;

                foreach ($fields as $field_item)
                {
                    if ($field_counter)
                    {
                        $field_counter = FALSE;

                        $html .= $field_item;
                        $html .= " LIKE ('%";
                        $html .= $term_item;
                        $html .= "%')";
                    }
                    else
                    {
                        $html .= "OR ";
                        $html .= $field_item;
                        $html .= " LIKE ('%";
                        $html .= $term_item;
                        $html .= "%')";
                    }
                }

                $html .= " ) ";
            }

            $html .= " ) ";

            return $html;
        }

        return FALSE;
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Value for given language
    *
    * @param string $language
    * @param string $primary
    * @param string $secondary
    *
    * @return string
    */
    public static function language_value($language, $primary, $secondary='')
    {
        $secondary = empty($secondary) ? $primary : $secondary;

        switch ($language)
        {
            case 'serbian': return $secondary;
            default: return $primary;
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Prepares SQL statement
    *
    * @param string $term
    * @param array $fields
    *
    * @return mixed
    */
    public static function in_wizard($term, $fields)
    {
        if ( ! empty($term) && ! empty($fields))
        {
            $sql         = '';
            $counter     = 1;
            $fields_size = count($fields);

            $sql  = ' AND ';
            $sql .= $term;
            $sql .= ' IN (';

            foreach ($fields as $item)
            {
                $sql .= '"';
                $sql .= $item;
                $sql .= '"';

                if ($counter < $fields_size)
                {
                    $sql .= ', ';
                }

                $counter++;
            }

            $sql .= ')';

            return $sql;
        }

        return FALSE;
    }

    /* ---------------------------------------------------------------------- */
}
