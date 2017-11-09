<?php
/*
| -------------------------------------------------------------------
| SPIDER
| -------------------------------------------------------------------
|
| This script crawls for visitor's data. It's possible 
| to display them, write to database and send via email.
|
| -------------------------------------------------------------------
*/
include_once '../../autoload.php';

// -----------------------------------------------------------------------------

/**
* Function for collecting data
* 
* @param mixed $to_display
* 
* @return Arrray $data
*/
function spider($to_display=FALSE)
{
    // Geo Plugin class instance
    $geo_plugin = new phplibrary\Geo_Plugin();
    $geo_plugin->locate();
    $data = $geo_plugin->data();

    phplibrary\Format::pre($data, $to_display);
    
    return $data;
}

/**
* Function for operations over collected data
* 
* @param Array $params
* 
* @return void
*/
function operate($params=array())
{
    // -------------------------------------------------------------------------
    
    if(isset($params['triggers']))
    {
        $to_redirect = $params['triggers']['redirect'];;
        $to_exit     = $params['triggers']['exit'];
    }
    else
    {
        $to_redirect = FALSE;
        $to_exit     = FALSE;
    }
    
    if(isset($params['settings']))
    {
        $to_redirect_location = $params['settings']['to_redirect_location'];
        $timezone             = $params['settings']['timezone'];;
    }
    else
    {
        $to_redirect_location = '';
        $timezone             = 'Europe/Belgrade';
    }
    
    if(isset($params['database']))
    {
        $database_connection = $params['database']['connection']; // Set query if TRUE
        $database_servername = $params['database']['servername'];
        $database_username   = $params['database']['username'];
        $database_password   = $params['database']['password'];
    }
    else
    {
        $database_connection = FALSE;
    }
    
    if(isset($params['mail']))
    {
        $mail_to_send = $params['mail']['to_send'];
        $mail_to      = $params['mail']['to'];
        $mail_from    = $params['mail']['from'];
        $mail_subject = $params['mail']['subject'];
        $mail_message = $params['mail']['message'];
        $mail_headers = 'From: ' . $mail_from . "\r\n" . 'Reply-To: ' . $mail_from . "\r\n";
    }
    else
    {
        $mail_to_send = FALSE;
    }
    
    // -------------------------------------------------------------------------
    
    // Default timezone
    date_default_timezone_set($timezone);
    
    // Database connection
    if($database_connection)
    {
        $connection = new mysqli($database_servername, $database_username, $database_password);
        
        mysqli_query($connection, "INSERT INTO table_name(table_fields) VALUES(table_values);");
        mysqli_close($connection);
    }

    // Send mail if trigger is set
    if($mail_to_send)
    {
	    mail($mail_to, $mail_subject, $mail_message, $mail_headers);
    }
    
    // Redirect if trigger is set
    if($to_redirect)
    {
        header("Location: $to_redirect_location");
    }

    // Exit if trigger is set
    if($to_exit)
    {
        exit();
    }

    // -------------------------------------------------------------------------
}

// -----------------------------------------------------------------------------

/**
* Implementation
*/
$spider = spider(TRUE);
$operate = operate(array(
    'triggers' => array(
        'redirect' => FALSE,
        'exit'     => FALSE,
    ),
    'settings' => array(
        'timezone'             => 'Europe/Belgrade',
        'to_redirect_location' => '',
    ),
    'database' => array(
        'connection' => FALSE, // Set query if TRUE
        'servername' => 'your_servername',
        'username'   => 'your_username',
        'password'   => 'your_password',
    ),
    'mail'     => array(
        'to_send' => FALSE,
        'to'      => 'your-name@example.com',
        'from'    => 'sender-name@example.com',
        'subject' => 'Spider',
        'message' => 'New spider message',
    ),
));

// -----------------------------------------------------------------------------