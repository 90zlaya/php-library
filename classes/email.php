<?php
/*
| -------------------------------------------------------------------
| EMAIL
| -------------------------------------------------------------------
|
| Email-related operations
|
| -------------------------------------------------------------------
*/
namespace phplibrary;

class Email {
    protected static $valid_email_regex     = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,6})$/i";
    protected static $invalid_email_clients = array(
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
    * Formats email to mailto format
    * 
    * @param String $email
    * @param String $link_text
    * @param String $subject
    * @param String $attributes
    * 
    * @return String $formated_email
    */
    public static function mailto($email, $link_text='', $subject='', $attributes='')
    {
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $formated_email = '';
        }
        else
        {
            if (empty($link_text))
            {
                $link_text = $email;
            }
            
            $email = str_replace('@', '&#64;', $email);
            $email = str_replace('.', '&#46;', $email);
            $email = str_split($email, 5);

            $link_text = str_replace('@', '&#64;', $link_text);
            $link_text = str_replace('.', '&#46;', $link_text);
            $link_text = str_split($link_text, 5);

            $part1 = '<a href="ma';
            $part2 = 'ilto&#58;';
            $part_subject = '?subject='.$subject.'';
            $part3 = '" '. $attributes .' >';
            $part4 = '</a>';

            $formated_email = '<script type="text/javascript">';
            $formated_email .= "document.write('$part1');";
            $formated_email .= "document.write('$part2');";

            foreach ($email as $e){
                $formated_email .= "document.write('$e');";
            }

            $formated_email .= "document.write('$part_subject');";
            $formated_email .= "document.write('$part3');";

            foreach ($link_text as $l){
                $formated_email .= "document.write('$l');";
            }

            $formated_email .= "document.write('$part4');";
            $formated_email .= '</script>';
        }
        
        return $formated_email;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Validates email address
    * 
    * @param String $email
    * @param Array $invalid_email_clients
    * 
    * @return Bool
    */
    public static function validate($email, $invalid_email_clients=array())
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
        
        return preg_match(self::$valid_email_regex, $email);
    }
    
    // -------------------------------------------------------------------------
}
?>