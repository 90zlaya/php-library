<?php
/**
* Web service related data
*/
class Web_Service{
    
    // -------------------------------------------------------------------------
    
    /**
    * Reading response body
    * 
    * Pass data values if your web service requires them.
    * 
    * @param String $web_service_url
    * @param String $data
    */
    public static function response_body($web_service_url, $data='')
    {
        $data_string = json_encode($data);
        $ch = curl_init($web_service_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data_string)));
        $result = curl_exec($ch);
        $arr = json_decode($result, true);
    return $arr;
    }
    
    // -------------------------------------------------------------------------
}
?>