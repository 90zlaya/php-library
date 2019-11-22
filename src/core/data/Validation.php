<?php
/**
* Validation
*
* Validation methods
*
* @package      PHP_Library
* @subpackage   Core
* @category     Data
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace PHP_Library\Core\Data;

/**
* Validation methods
*/
class Validation {

    /* ---------------------------------------------------------------------- */

    /**
    * Validates year format
    *
    * @param int $year
    *
    * @return bool
    */
    public static function year($year)
    {
        return is_numeric($year) && strlen( (string) $year) === strlen(date('Y'));
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Replaces comma with dot
    *
    * @param string $param
    *
    * @return string
    */
    public static function comma($param)
    {
        if (strpos($param, ',') !== FALSE)
        {
            return str_replace(',', '.', $param);
        }

        return $param;
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Clears string of special characters
    *
    * @param string $variable
    * @param bool $to_trim
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

    /* ---------------------------------------------------------------------- */

    /**
    * Clears integer - returns zero if not propper
    *
    * @param string $variable
    *
    * @return int
    */
    public static function clear_number($variable)
    {
        return is_numeric($variable) ? (int) $variable : 0;
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Rewriting string parameters
    *
    * @param string $string
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

    /* ---------------------------------------------------------------------- */

    /**
    * Rewriting string parameters with special characters
    *
    * @param string $string
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
            $string_trimmed  = trim( (string) $string_replaced);

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

    /* ---------------------------------------------------------------------- */

    /**
    * Checks if file extension is valid or not
    *
    * @param string $file
    * @param array $allowed_extensions
    * @param string $type
    * @param array $allowed_types
    *
    * @return bool
    */
    public static function extension($file, $allowed_extensions, $type='', $allowed_types=array())
    {
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        $extension = strtolower($extension);

        return in_array($extension, $allowed_extensions) &&
            in_array($type, $allowed_types);
    }

    /* ---------------------------------------------------------------------- */
}
