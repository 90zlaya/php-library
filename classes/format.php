<?php
class Format{
    public static $ip_locator           = 'http://www.infosniper.net/index.php?ip_address=';
    public static $ip_localhost_address = '::1';
    public static $ip_localhost_name    = 'Localhost';
    
    public static function bytes_to_megabytes(){
        $base = log($size) / log(1024);             
        $f_base = floor($base);
    return round(pow(1024, $base - floor($base)), 1) .' '. 'MB';
    }
    
    public static function query($query) {                        
        $queryPrint = str_ireplace('<', '&lt;', $query);
        $queryPrint = str_ireplace('>', '&gt;', $queryPrint);
    return '<pre><code>'. $queryPrint .'</code></pre>';
    }
    
    public static function string($string, $length, $start=0){
        if( strlen($string) > $length ){
            return substr($string, $start, $length) .' '.  '...';
        }else{
            return $string;
        }
    }
    
    public static function telephone($telephone='', $telephone2=''){
        if( empty($telephone) ){
            $telephone = $telephone2;
        }
        
        if( empty($telephone)){
            $result = '';
        }else{
            $exploded_telephone = explode(' ', $telephone);
            
            $telephone_print = '';
            foreach($exploded_telephone as $row){
                $telephone = trim($row);
                $telephone = preg_replace('/[^0-9,.]/', '', $telephone);
                $telephone_print .= $telephone; 
            }        

            $first  = substr($telephone_print, 0, 3);
            $second = substr($telephone_print, 3, 2);
            $third  = substr($telephone_print, 5, 2);
            $fourth = substr($telephone_print, 7, 5);
            
            if( empty($exploded_telephone) ){
                $result = 'N/A';                    
            }else{            
                $result = $first .'/'. $second .'-'. $third .'-'. $fourth;
            }
        }       
    return $result;
    }
    
    public static function website($location, $name=false){
        $prefix_protocol = 'http://';
        $prefix_web      = 'www.';
        
        if( strpos($location, $prefix_web) !== false ){
            $prefix = $prefix_protocol;
        }else{
            $prefix = $prefix_protocol . $prefix_web;   
        }
        
        $location_final = $prefix . $location;
        
        if($name){
            return $location_final;
        }else{
            return ' ' . '<a href="'. $location_final .'" target="_blank">'. $location .'</a>' . ' ';
        }
    } 
    
    public static function ip($ip){
        if( $ip == self::$ip_localhost_address ){
            return self::$ip_localhost_name;
        }else{
            return '<a href="'. self::$ip_locator . $ip .'" target="_blank">'. $ip .'</a>';
        }
    }
    
    // POTREBNA REVIZIJA FUNKCIJE IAKO SVE RADI
    public static function email($eMail='', $subject='Poruka', $body='Poštovani, %0A%0A%0A', $viseMejlova='Prvi'){              
        if($eMail!=""){ // ima imejlova
            $trigerViseMejlova = false; // sluzi za ispis | kod mejlova
            $explodeEmail = explode(";", $eMail);
            
            switch($viseMejlova){
                case "Svi": 
                    {
                        foreach($explodeEmail as $podatak){
                            $eMail = trim($podatak);
                            
                            // ispitivanje trigera - ulazi kada treba da se ispise drugi mejl
                            if($trigerViseMejlova)
                                $rezultat .= "&nbsp;|&nbsp;";
                                
                            $rezultat .= "<a href='mailto:".$eMail."?subject=".$subject."&body=".$body."'>".$eMail."</a>";
                
                            // postavljanje trigera kada treba da se prikaze | (uspravnu crtu) za jos mejlova
                            if($trigerViseMejlova)
                                $trigerViseMejlova=false;
                            else    
                                $trigerViseMejlova=true;
                        } // kraj foreach za vrtenje                    
                    }break;
                case "Prvi": 
                    {
                        $rezultat = "<a href='mailto:".$explodeEmail[0]."?subject=".$subject."&body=".$body."'>"; 
                        $rezultat .= $explodeEmail[0]; 
                        $rezultat .= "</a>";                    
                    }break;            
            }
        }else{
            $rezultat = "Nepoznat";
        } 
    return $rezultat;
    }
    
    public static function title_case($title){
        return ucfirst(strtolower($title));
    }
}
?>