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
* @return Arrray $spider
*/
function spider($to_display=FALSE)
{
    // Geo Plugin class instance
    $geo_plugin = new phplibrary\Geo_Plugin();
    $geo_plugin->locate();
    $data = $geo_plugin->data();

    phplibrary\Format::pre($data, $to_display);
    
    return array(
        'status' => $geo_plugin->is_active_service(),
        'data'   => $data,
    );
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
    
    if (isset($params['triggers']))
    {
        $to_redirect = $params['triggers']['redirect'];;
        $to_exit     = $params['triggers']['exit'];
    }
    else
    {
        $to_redirect = FALSE;
        $to_exit     = FALSE;
    }
    
    if (isset($params['settings']))
    {
        $to_redirect_location = $params['settings']['to_redirect_location'];
        $timezone             = $params['settings']['timezone'];;
    }
    else
    {
        $to_redirect_location = '';
        $timezone             = 'Europe/Belgrade';
    }
    
    if (isset($params['database']))
    {
        $database_connection = $params['database']['connection'];
        $database_engine     = $params['database']['engine'];
        $database_servername = $params['database']['servername'];
        $database_username   = $params['database']['username'];
        $database_password   = $params['database']['password'];
        $database_name       = $params['database']['name'];
        $table_name          = $params['database']['table']['name'];
        $table_fields        = $params['database']['table']['fields'];
        $table_values        = $params['database']['table']['values'];
    }
    else
    {
        $database_connection = FALSE;
    }
    
    if (isset($params['mail']))
    {
        $mail_to_send = $params['mail']['to_send'];
        $mail_to      = $params['mail']['to'];
        $mail_from    = $params['mail']['from'];
        $mail_subject = $params['mail']['subject'];
        $mail_message = $params['mail']['message'];
        $mail_headers = 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $mail_headers .= 'From: ' . $mail_from . "\r\n" . 'Reply-To: ' . $mail_from . "\r\n";
    }
    else
    {
        $mail_to_send = FALSE;
    }
    
    // -------------------------------------------------------------------------
    
    // Default timezone
    date_default_timezone_set($timezone);
    
    // Database connection
    if ($database_connection)
    {
        $counter = 0;
        $import_values = "";
        foreach ($table_values as $value)
        {
            if (empty($counter))
            {
                $prefix = '';
            }
            else
            {
                $prefix = ',';
            }
                
            $import_values .= $prefix . "'" . $value . "'";
            
            $counter++;
        }
        
        switch ($database_engine)
        {
            case 'mysql':
                {
                    @$connection = new mysqli($database_servername, $database_username, $database_password, $database_name);
                    $query = "INSERT INTO $table_name($table_fields) VALUES($import_values);";
                    @mysqli_query($connection, $query);
                    @mysqli_close($connection);
                } break;
            case 'mssql':
                {
                    $connection = new COM('ADODB.Connection');
                    $connection_string = 'PROVIDER=SQLOLEDB;SERVER=' . $database_servername . ';UID=' . $database_username . ';PWD=' . $database_password . ';DATABASE=' . $database_name;
                    $connection->open($connection_string);
                    
                    $query = "INSERT INTO $table_name($table_fields) VALUES($import_values);";
                    $connection->execute($query);
                } break;
        }
    }

    // Send mail if trigger is set
    if ($mail_to_send)
    {
	    mail($mail_to, $mail_subject, $mail_message, $mail_headers);
    }
    
    // Redirect if trigger is set
    if ($to_redirect)
    {
        header("Location: $to_redirect_location");
    }

    // Exit if trigger is set
    if ($to_exit)
    {
        exit();
    }

    // -------------------------------------------------------------------------
}

// -----------------------------------------------------------------------------

/**
* Collect data
*/
$spider = spider(FALSE);

if ($spider['status'])
{
    $ip = isset($spider['data']['base']['ip']) ? $spider['data']['base']['ip'] : NULL;
    $ua = isset($spider['data']['base']['ua']) ? $spider['data']['base']['ua'] : NULL;
    
    operate(array(
        'triggers' => array(
            'redirect' => FALSE,
            'exit'     => FALSE,
        ),
        'settings' => array(
            'timezone'             => 'Europe/Belgrade',
            'to_redirect_location' => '',
        ),
        'database' => array(
            'connection' => TRUE,
            'engine'     => 'mysql',
            'servername' => 'localhost',
            'username'   => 'root',
            'password'   => '',
            'name'       => 'test',
            'table'      => array(
                'name'   => 'spider',
                'fields' => 'ip, ua',
                'values' => array(
                    $ip,
                    $ua,
                ),
            ),
        ),
        'mail'     => array(
            'to_send' => FALSE,
            'to'      => 'your-name@example.com',
            'from'    => 'sender-name@example.com',
            'subject' => 'Spider',
            'message' => 'New spider message',
        ),
    ));
}
else
{
    operate(array(
        'mail'     => array(
            'to_send' => TRUE,
            'to'      => 'your-name@example.com',
            'from'    => 'sender-name@example.com',
            'subject' => 'Spider failed',
            'message' => 'Spider moudle failed to collect data',
        ),
    ));
}

// -----------------------------------------------------------------------------