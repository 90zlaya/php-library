<?php
    class DirectoryLister{     
        public static function list($directory){
            $files = scandir($directory);
            $arr_folder = Array();
            $counter = 1;
            foreach($files as $folder){
                if( $counter > 2 ){
                    if( stripos($folder, '.') ){
                        $exploded = explode('.', $folder);  
                        
                        if( is_numeric( end($exploded) ) ){
                            array_push($arr_folder, $folder);
                        }
                    }else{
                        array_push($arr_folder, $folder);
                    }
                }
            $counter++;
            }
        return $arr_folder;
        }
    }
?>