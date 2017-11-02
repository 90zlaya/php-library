<?php
/*
| -------------------------------------------------------------------
| SPIDER
| -------------------------------------------------------------------
|
| This script crawls for visitor's data. It's possible 
| to display them, write to database and send via email.
| 
| Notice: This module can be installed as standalone in this format.
| 
| Add include_once '../../autoload.php'; if you want to experiment
| with PHP Library.
|
| -------------------------------------------------------------------
*/

// Third-party class
class geoPlugin {    
    //the geoPlugin server
    var $host = 'http://www.geoplugin.net/php.gp?ip={IP}&base_currency={CURRENCY}';
        
    //the default base currency
    var $currency = 'USD';
    
    //initiate the geoPlugin vars
    var $ip = null;
    var $city = null;
    var $region = null;
    var $areaCode = null;
    var $dmaCode = null;
    var $countryCode = null;
    var $countryName = null;
    var $continentCode = null;
    var $latitude = null;
    var $longitude = null;
    var $currencyCode = null;
    var $currencySymbol = null;
    var $currencyConverter = null;
    
    function geoPlugin() {

    }
    
    function locate($ip = null) {
        
        global $_SERVER;
        
        if ( is_null( $ip ) ) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        
        $host = str_replace( '{IP}', $ip, $this->host );
        $host = str_replace( '{CURRENCY}', $this->currency, $host );
        
        $data = array();
        
        $response = $this->fetch($host);
        
        $data = unserialize($response);
        
        //set the geoPlugin vars
        $this->ip = $ip;
        $this->city = $data['geoplugin_city'];
        $this->region = $data['geoplugin_region'];
        $this->areaCode = $data['geoplugin_areaCode'];
        $this->dmaCode = $data['geoplugin_dmaCode'];
        $this->countryCode = $data['geoplugin_countryCode'];
        $this->countryName = $data['geoplugin_countryName'];
        $this->continentCode = $data['geoplugin_continentCode'];
        $this->latitude = $data['geoplugin_latitude'];
        $this->longitude = $data['geoplugin_longitude'];
        $this->currencyCode = $data['geoplugin_currencyCode'];
        $this->currencySymbol = $data['geoplugin_currencySymbol'];
        $this->currencyConverter = $data['geoplugin_currencyConverter'];
        
    }
    
    function fetch($host) {

        if ( function_exists('curl_init') ) {
                        
            //use cURL to fetch data
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $host);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'geoPlugin PHP Class v1.0');
            $response = curl_exec($ch);
            curl_close ($ch);
            
        } else if ( ini_get('allow_url_fopen') ) {
            
            //fall back to fopen()
            $response = file_get_contents($host, 'r');
            
        } else {

            trigger_error ('geoPlugin class Error: Cannot retrieve data. Either compile PHP with cURL support or enable allow_url_fopen in php.ini ', E_USER_ERROR);
            return;
        
        }
        
        return $response;
    }
    
    function convert($amount, $float=2, $symbol=true) {
        
        //easily convert amounts to geolocated currency.
        if ( !is_numeric($this->currencyConverter) || $this->currencyConverter == 0 ) {
            trigger_error('geoPlugin class Notice: currencyConverter has no value.', E_USER_NOTICE);
            return $amount;
        }
        if ( !is_numeric($amount) ) {
            trigger_error ('geoPlugin class Warning: The amount passed to geoPlugin::convert is not numeric.', E_USER_WARNING);
            return $amount;
        }
        if ( $symbol === true ) {
            return $this->currencySymbol . round( ($amount * $this->currencyConverter), $float );
        } else {
            return round( ($amount * $this->currencyConverter), $float );
        }
    }
    
    function nearby($radius=10, $limit=null) {

        if ( !is_numeric($this->latitude) || !is_numeric($this->longitude) ) {
            trigger_error ('geoPlugin class Warning: Incorrect latitude or longitude values.', E_USER_NOTICE);
            return array( array() );
        }
        
        $host = "http://www.geoplugin.net/extras/nearby.gp?lat=" . $this->latitude . "&long=" . $this->longitude . "&radius={$radius}";
        
        if ( is_numeric($limit) )
            $host .= "&limit={$limit}";
            
        return unserialize( $this->fetch($host) );

    }
}

// -----------------------------------------------------------------------------

// Class instance
$geoplugin = new geoPlugin();
$geoplugin->locate();

// Collect data
$data = array(
    'page_name'             => $_SERVER['PHP_SELF'],
    'ua'                    => $_SERVER['HTTP_USER_AGENT'],
    'ip'                    => $geoplugin->ip,
    'city'                  => $geoplugin->city,
    'region'                => $geoplugin->region,
    'longitude'             => $geoplugin->longitude,
    'latitude'              => $geoplugin->latitude,
    'area_code'             => $geoplugin->areaCode,
    'dma_code'              => $geoplugin->dmaCode,
    'country_name'          => $geoplugin->countryName,
    'country_code'          => $geoplugin->countryCode,
    'continent_code'        => $geoplugin->continentCode,
    'currency_symbol'       => $geoplugin->currencySymbol,
    'currency_converter'    => $geoplugin->currencyConverter,
    'currency_code'         => $geoplugin->currencyCode,
);

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
