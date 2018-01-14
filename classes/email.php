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
    * Show email address
    * 
    * @param String $email
    * 
    * @return mixed
    */
    public static function show($email)
    {
        if (self::validate($email))
        {
            $email      = strtolower($email);
            $email      = str_replace('@', '&#64;', $email);
            $email      = str_replace('.', '&#46;', $email);
            $email      = str_split($email, 5);
            
            $scripted   = '';
            
            $scripted  .= '<script type="text/javascript">';
            
            foreach ($email as $e)
            {
                $scripted .= "document.write('$e');";
            }
            
            $scripted  .= '</script>';
            
            return $scripted;
        }
        
        return FALSE;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Formats email to mailto format
    * 
    * @param String $email
    * @param String $link_text
    * @param String $subject
    * @param String $attributes
    * 
    * @return mixed
    */
    public static function mailto($email, $link_text='', $subject='', $attributes='')
    {
        if (self::validate($email))
        {
            $email = strtolower($email);
                        
            empty($link_text) ? $link_text = $email : NULL;
            
            $parts = array(
                '<a href="ma',
                'ilto&#58;',
                '?subject=' . $subject,
                '" ' . $attributes . ' >',
                '</a>',
            );
                        
            $email      = str_replace('@', '&#64;', $email);
            $email      = str_replace('.', '&#46;', $email);
            $email      = str_split($email, 5);

            $link_text  = str_replace('@', '&#64;', $link_text);
            $link_text  = str_replace('.', '&#46;', $link_text);
            $link_text  = str_split($link_text, 5);
            
            $scripted   = '';
            
            $scripted  .= '<script type="text/javascript">';
            $scripted  .= "document.write('" . $parts[0] . "');";
            $scripted  .= "document.write('" . $parts[1] . "');";

            foreach ($email as $e)
            {
                $scripted .= "document.write('$e');";
            }

            $scripted  .= "document.write('" . $parts[2] . "');";
            $scripted  .= "document.write('" . $parts[3] . "');";

            foreach ($link_text as $l)
            {
                $scripted .= "document.write('$l');";
            }
            
            $scripted  .= "document.write('" . $parts[4] . "');";
            $scripted  .= '</script>';
            
            return $scripted;
        }
        
        return FALSE;
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
}
?>