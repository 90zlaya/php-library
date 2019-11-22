<?php
/**
* Password
*
* Works with password related data
*
* @package      PHP_Library
* @subpackage   Core
* @category     Data
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace PHP_Library\Core\Data;

/**
* Works with password related data
*/
class Password {

    /* ---------------------------------------------------------------------- */

    /**
    * Method for openssl_digest in digest method
    *
    * @var string
    */
    private static $method = 'sha512';

    /* ---------------------------------------------------------------------- */

    /**
    * Password letters
    *
    * @var string
    */
    private static $letters = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';

    /* ---------------------------------------------------------------------- */

    /**
    * Password words
    *
    * @var string
    */
    private static $words = 'dog,cat,sheep,sun,sky,red,ball,happy,ice,green,blue,music,movies,radio,green,turbo,mouse,computer,paper,water,fire,storm,chicken,boot,freedom,white,nice,player,small,eyes,path,kid,box,black,flower,ping,pong,smile,coffee,colors,rainbow,plus,king,tv,ring';

    /* ---------------------------------------------------------------------- */

    /**
    * Password sizes
    *
    * @var array
    */
    private static $sizes = array(
        'minimum' => 6,
        'optimum' => 9,
    );

    /* ---------------------------------------------------------------------- */

    /**
    * Encode/decode replaceable characters
    *
    * @var array
    */
    private static $replaceables = array(
        'search'  => '+/=',
        'replace' => '-_,',
    );

    /* ---------------------------------------------------------------------- */

    /**
    * Generates new unreadable password
    *
    * @param int $size_optimum
    * @param string $letters
    *
    * @return string
    */
    public static function new_unreadable($size_optimum=0, $letters='')
    {
        empty($size_optimum) ? $size_optimum = self::$sizes['optimum'] : NULL;

        empty($letters) ? $letters = self::$letters : NULL;

        return substr(str_shuffle($letters), 0, $size_optimum);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Generates new readable password
    *
    * @param int $size_optimum
    * @param string $words
    *
    * @return string
    */
    public static function new_readable($size_optimum=0, $words='')
    {
        empty($size_optimum) ? $size_optimum = self::$sizes['optimum'] : NULL;

        empty($words) ? $words = self::$words : NULL;

        $words               = explode(',', $words);
        $new_password        = '';
        $new_password_length = 0;

        while ($new_password_length < $size_optimum)
        {
            $r = mt_rand(0, count($words)-1);

            $new_password .= $words[$r];

            $new_password_length = strlen($new_password);
        }

        $number = mt_rand(1000, 9999);

        if ($size_optimum > 2)
        {
            return substr(
                $new_password,
                0,
                $size_optimum - strlen( (string) $number)
            ) . $number;
        }
        else
        {
            return substr(
                $new_password,
                0,
                $size_optimum
            );
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Calculates password strength
    *
    * @param string $string
    * @param int $minimum_strength_percent
    *
    * @return array
    */
    public static function strength($string, $minimum_strength_percent=60)
    {
        $strength = 0;
        $h        = 0;
        $size     = strlen($string);

        if ($size >= self::$sizes['minimum'])
        {
            foreach (count_chars($string, 1) as $v)
            {
                $p  = $v / $size;
                $h -= $p * log($p) / log(2);
            }

            $strength = ($h / 4) * 100;

            $strength > 100 ? $strength = 100 : NULL;
        }

        return array(
            'status'   => $strength > $minimum_strength_percent,
            'strength' => $strength,
        );
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Base 64 encode
    *
    * @param string $plain_text
    *
    * @return string
    */
    public static function encode($plain_text)
    {
        return strtr(
            base64_encode($plain_text),
            self::$replaceables['search'],
            self::$replaceables['replace']
        );
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Base 64 decode
    *
    * @param string $plain_text
    *
    * @return mixed
    */
    public static function decode($plain_text)
    {
        return base64_decode(
            strtr(
                $plain_text,
                self::$replaceables['replace'],
                self::$replaceables['search']
            )
        );
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Computes a digest
    *
    * @param string $plain_text
    *
    * @return mixed
    */
    public static function digest($plain_text)
    {
        if (
            ! empty($plain_text) &&
            ! empty(self::get_method()) &&
            in_array(self::get_method(), openssl_get_md_methods())
        )
        {
            return openssl_digest($plain_text, self::get_method());
        }

        return FALSE;
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Get method attribute
    *
    * @return string self::$method
    */
    private static function get_method()
    {
        return self::$method;
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Set method attribute
    *
    * @param string $value
    *
    * @return void
    */
    public static function set_method($value)
    {
        self::$method = $value;
    }

    /* ---------------------------------------------------------------------- */
}
