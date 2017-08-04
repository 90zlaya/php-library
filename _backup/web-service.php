<?php
    class WebService{
        public static function responseBody($webServiceURL, $data=''){
            $data_string = json_encode($data);                                                                                                                     
            $ch = curl_init($webServiceURL);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: '. strlen($data_string)) );
            $result = curl_exec($ch);
            $arr = json_decode($result, true);
        return $arr;
        }
    }
?>