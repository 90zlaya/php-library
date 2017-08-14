<?php
/**
* Directory content retrieval
*/
class Directory_Lister{
    
    // -------------------------------------------------------------------------
    
    /**
    * Reading contents for given directory
    *
    * @param String $directory
    */
    public static function read($directory='')
    {
        if(empty($directory))
        {
            return FALSE;
        }
        else
        {
            $files = scandir($directory);
            $arr_folder = array();
            $counter = 1;
            foreach($files as $folder)
            {
                if($counter > 2)
                {
                    if(stripos($folder, '.'))
                    {
                        $exploded = explode('.', $folder);  
                        
                        if(is_numeric(end($exploded)))
                        {
                            array_push($arr_folder, $folder);
                        }
                    }
                    else
                    {
                        array_push($arr_folder, $folder);
                    }
                }
            $counter++;
            }
            
            return $arr_folder;
        }
    }
    
    // -------------------------------------------------------------------------
}
?>