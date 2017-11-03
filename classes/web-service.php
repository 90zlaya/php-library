<?php
/*
| -------------------------------------------------------------------
| WEB SERVICE
| -------------------------------------------------------------------
|
| Web service related data
|
| -------------------------------------------------------------------
*/
namespace phplibrary;

class Web_Service{
    
    // -------------------------------------------------------------------------
    
    /**
    * Reading response body
    * 
    * Pass data values if your web service requires them.
    * 
    * @param String $web_service_url
    * @param String $data
    * 
    * @return Array $arr
    */
    public static function response_body($web_service_url, $data=array())
    {
        $data_string = json_encode($data);
        $ch = curl_init($web_service_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data_string)));
        $result = curl_exec($ch);
        $arr = json_decode($result, TRUE);
    
        return $arr;
    }
    
    // -------------------------------------------------------------------------
}
?>