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
            return self::script(self::split($email));
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
            
            return self::script(
                self::split(
                    '<a href="mailto&#58;' . $email . '?subject=' . $subject . '"' . $attributes . '>' . $link_text . '</a>',
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
    
    /**
    * Return array inside <script></script> tags
    * 
    * @param Array $data
    * 
    * @return String $scripted
    */
    private static function script($data)
    {
        $scripted   = '';
        
        $scripted  .= '<script type="text/javascript">';
        
        foreach ($data as $item)
        {
            $scripted .= "document.write('$item');";
        }
        
        $scripted  .= '</script>';
        
        return $scripted;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Split data
    * 
    * @param String $data
    * @param Bool $to_lower
    * @param int $parts
    * 
    * @return Array
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
?>