<?php
/**
* Email
*
* Email-related operations
*
* @package      PHP_Library
* @subpackage   Core
* @category     Arrangements
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace PHP_Library\Core\Arrangements;

/**
* Email-related operations
*/
class Email {

    // -------------------------------------------------------------------------

    /**
    * Valid email regex
    *
    * @var string
    */
    private static $valid_email_regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,6})$/i";

    // -------------------------------------------------------------------------

    /**
    * Invalid email clients
    *
    * @var array
    */
    private static $invalid_email_clients = array(
        "@yopmail",
        "@rmqkr",
        "@emailtemporanea",
        "@sharklasers",
        "@guerrillamail",
        "@guerrillamailblock",
        "@fakeinbox",
        "@tempinbox",
        "@opayq",
        "@mailinator",
        "@notmailinator",
        "@getairmail",
        "@meltmail",
    );

    // -------------------------------------------------------------------------

    /**
    * Show email address
    *
    * @param string $email
    *
    * @return mixed
    */
    public static function show($email)
    {
        if (self::validate($email))
        {
            return self::script(self::split($email));
        }

        return FALSE;
    }

    // -------------------------------------------------------------------------

    /**
    * Formats email to mailto format
    *
    * @param string $email
    * @param string $link_text
    * @param string $subject
    * @param string $attributes
    *
    * @return mixed
    */
    public static function mailto($email, $link_text='', $subject='', $attributes='')
    {
        if (self::validate($email))
        {
            $email = strtolower($email);

            empty($link_text) ? $link_text = $email : NULL;

            $split_me  = '<a href="mailto&#58;';
            $split_me .= $email;
            $split_me .= '?subject=';
            $split_me .= $subject;
            $split_me .= '"';
            $split_me .= $attributes;
            $split_me .= '>';
            $split_me .= $link_text;
            $split_me .= '</a>';

            return self::script(
                self::split(
                    $split_me,
                    FALSE
                )
            );
        }

        return FALSE;
    }

    // -------------------------------------------------------------------------

    /**
    * Validates email address
    *
    * @param string $email
    * @param array $invalid_email_clients
    *
    * @return bool
    */
    public static function validate($email, $invalid_email_clients=array())
    {
        if ( ! empty($email))
        {
            if (empty($invalid_email_clients))
            {
                $invalid_email_clients = self::$invalid_email_clients;
            }

            foreach ($invalid_email_clients as $item)
            {
                if (stristr($email, $item))
                {
                    return FALSE;
                }
            }

            if (preg_match(self::$valid_email_regex, $email))
            {
                return filter_var($email, FILTER_VALIDATE_EMAIL);
            }
        }

        return FALSE;
    }

    // -------------------------------------------------------------------------

    /**
    * Return array inside <script></script> tags
    *
    * @param array $data
    *
    * @return string $scripted
    */
    private static function script($data)
    {
        $scripted = '';

        $scripted .= '<script type="text/javascript">';

        foreach ($data as $item)
        {
            $scripted .= "document.write('$item');";
        }

        $scripted .= '</script>';

        return $scripted;
    }

    // -------------------------------------------------------------------------

    /**
    * Split data
    *
    * @param string $data
    * @param bool $to_lower
    * @param int $parts
    *
    * @return mixed
    */
    private static function split($data, $to_lower=TRUE, $parts=5)
    {
        $to_lower ? $data = strtolower($data) : NULL;

        $data = str_replace('@', '&#64;', $data);
        $data = str_replace('.', '&#46;', $data);

        return str_split($data, $parts);
    }

    // -------------------------------------------------------------------------
}
