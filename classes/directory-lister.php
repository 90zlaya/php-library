<?php
/**
* Directory content retrieval
*/
class Directory_Lister{
    protected static $directory = '';
    
    // -------------------------------------------------------------------------
    
    /**
    * Reading folder contents for given directory
    *
    * @param String $directory
    * 
    * @return mixed
    */
    public static function folders($directory='')
    {
        if(empty($directory))
        {
            $directory = self::$directory;
        }
        else
        {
            self::$directory = $directory;
        }
        
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
    
    // -------------------------------------------------------------------------
    
    /**
    * Reading file contents for given directory
    *
    * @param String $directory
    * 
    * @return mixed
    */
    public static function files($directory='')
    {
        if(empty($directory))
        {
            $directory = self::$directory;
        }
        else
        {
            self::$directory = $directory;
        }
        
        $files = scandir($directory);
        $arr_files = array();
        $counter = 1;
        foreach($files as $folder)
        {
            if($counter > 2)
            {
                if(stripos($folder, '.'))
                {
                    $exploded = explode('.', $folder);  
                    array_push($arr_files, $folder);
                }
            }
            
            $counter++;
        }
        
        return $arr_files;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Searches specific directory reading results
    * 
    * @param Array $list
    * @param String $delimiter
    * 
    *  @return mixed
    */
    public static function search($list, $delimiter='')
    {
        $arr_filtered = array();
            
        if(empty($list))
        {
            return $arr_filtered;
        }
        else if(empty($delimiter))
        {
            return $list;
        }
        else
        {
            foreach($list as $item)
            {
                if(stripos($item, $delimiter) !== FALSE)
                {
                    array_push($arr_filtered, $item);
                }
            }
            
            return $arr_filtered;
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Displaying images
    * 
    * @param String $list
    * @param String $directory
    * @param Array $mime_types
    * 
    * @return mixed
    */
    public static function display($list, $mime_types=array())
    {
        $arr_display = array();
        
        if(empty($list))
        {
            return $arr_display;
        }
        else if(empty($mime_types))
        {
            return $list;
        }
        else
        {
            foreach($list as $item)
            {
                if($item)
                {
                    $link = '<img src="' . self::$directory . $item . '">';
                    array_push($arr_display, $link);
                }
            }
            
            return $arr_display;
        }
    }
    
    // -------------------------------------------------------------------------
}
?>