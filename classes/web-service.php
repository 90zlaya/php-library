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

class Web_Service {
    
    // -------------------------------------------------------------------------
    
    /**
    * Convert response code to service status
    * 
    * @param int $code
    * 
    * @return Array
    */
    public static function response_code($code)
    {
        $status = FALSE;
        
        switch ($code)
        {
            case 200: $status = TRUE; break;
        }
        
        return array(
            'status' => $status,
        );
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Reading response body
    * 
    * Pass data values if your web service requires them.
    * 
    * @param String $web_service_url
    * @param String $data
    * 
    * @return Array
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
        curl_close($ch);
        
        return json_decode($result, TRUE);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Check if remote file exists
    * 
    * @param String $url
    * 
    * @return Array
    */
    public static function check_file($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, TRUE);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        return array(
            'status' => self::response_code($code)['status'],
            'code'   => $code,
        );
    }
    
    // -------------------------------------------------------------------------
}
?>