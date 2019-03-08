<?php
/**
* Random
*
* Random-related data
*
* @package      PHP_Library
* @subpackage   Core
* @category     Data
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace PHP_Library\Core\Data;

/**
* Random-related data
*/
class Random {

    // -------------------------------------------------------------------------

    /**
    * Numeric caracters
    *
    * @var string
    */
    private static $numbers = '0123456789';

    // -------------------------------------------------------------------------

    /**
    * Alphanumeric caracters
    *
    * @var string
    */
    private static $alphanumeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    // -------------------------------------------------------------------------

    /**
    * Consonant characters
    *
    * @var array
    */
    private static $consonant = array(
        'b',
        'c',
        'd',
        'f',
        'g',
        'h',
        'j',
        'k',
        'l',
        'm',
        'n',
        'p',
        'r',
        's',
        't',
        'v',
        'w',
        'x',
        'y',
        'z',
    );

    // -------------------------------------------------------------------------

    /**
    * Vocal characters
    *
    * @var array
    */
    private static $vocal = array(
        'a',
        'e',
        'i',
        'o',
        'u',
    );

    // -------------------------------------------------------------------------

    /**
    * Generates random sequence for given length and sequence type
    *
    * @param int $length
    * @param string $type
    *
    * @return mixed
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
                        $readable_random_string .= strtoupper($conso[rand(0, 19)]);
                        $readable_random_string .= $vocal[rand(0, 4)];
                    }
                    else
                    {
                        $readable_random_string .= $conso[rand(0, 19)];
                        $readable_random_string .= $vocal[rand(0, 4)];
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
    * @param array $list
    * @param string $dose
    *
    * @return array $element
    */
    public static function element($list, $dose='')
    {
        $list_size = count($list);

        ($dose === 'DAY' && $list_size < 7) ||
        ($dose === 'MONTH' && $list_size < 31)
            ? $dose = ''
            : NULL;

        switch ($dose)
        {
            case 'DAY':
            {
                $index = (int) date('N') - 1;

                break;
            }
            case 'MONTH':
            {
                $index = (int) date('j') - 1;

                break;
            }
            default: $index = rand(0, $list_size - 1);
        }

        return $list[$index];
    }

    // -------------------------------------------------------------------------

    /**
    * Break caching for URLs
    *
    * @return string
    */
    public static function break_caching()
    {
        return '?break_caching=' . rand();
    }

    // -------------------------------------------------------------------------
}
