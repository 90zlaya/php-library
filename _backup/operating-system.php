<?php
    class OperatingSystem{     
        public static $first  = "Windows";
        public static $second = "BlackBerry";
        public static $third  = "Android";
        public static $fourth = "iOS";
        public static $fifth  = "Linux";
            
        public static function getList(){
            $list = array(
                self::$first,
                self::$second,
                self::$third,
                self::$fourth,
                self::$fifth
            );   
        return $list;
        }
    }
?>