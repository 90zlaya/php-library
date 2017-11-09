<?php
/*
| -------------------------------------------------------------------
| SPIDER
| -------------------------------------------------------------------
|
| This script crawls for visitor's data. It's possible 
| to display them, write to database and send via email.
| 
| Notice: This module can't be installed as standalone in this format, 
| because it heavily resides on PHP Library and it's methods.
|
| -------------------------------------------------------------------
*/
include_once '../../autoload.php';

$geo_plugin = new phplibrary\Geo_Plugin();
$geo_plugin->locate();
$data = $geo_plugin->data();

phplibrary\Format::pre($data, TRUE);

// -----------------------------------------------------------------------------

// Settings
$database_connection  = FALSE; // Set $database_query if TRUE
$database_servername  = 'your_servername';
$database_username    = 'your_username';
$database_password    = 'your_password';
$reference_name       = 'ref';
$timezone             = 'Europe/Belgrade';
$mail_to_send         = FALSE; // Set $mail_message if TRUE
$mail_to              = 'your-name@example.com';
$mail_from            = 'sender-name@example.com';
$mail_headers         = 'From: ' . $mail_from . "\r\n" . 'Reply-To: ' . $mail_from . "\r\n";
$mail_subject         = 'Spider';
$to_redirect          = FALSE;
$to_redirect_location = '';

// Default timezone
date_default_timezone_set($timezone);

// Reference
if(isset($_GET[$reference_name]))
{
    $reference = $_GET[$reference_name];
}
else
{
    $reference = '0';
}

// Database connection
if($database_connection)
{
    $conn           = new mysqli($database_servername, $database_username, $database_password);
    $database_query = "INSERT INTO table_name(field) VALUES('value');";
    $result         = mysqli_query($conn, $database_query);
}
else
{
    $conn = $database_query = $result = FALSE;
}

// Send mail if trigger is set
if($mail_to_send)
{
	$mail_message = 'Please set mail message';
    $mail_sent    = mail($mail_to, $mail_subject, $mail_message, $mail_headers);
}

// Close connection to database if open
if($database_connection)
{
    mysqli_close($conn);
}

// Redirect if trigger is set
if($to_redirect)
{
    header("Location: $to_redirect_location");
}

// Exit at the end of the script
exit();

// -----------------------------------------------------------------------------
