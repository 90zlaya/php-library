<?php
/**
* Directory content retrieval
*/
class Directory_Lister{
    protected static $directory   = '';
    protected static $date_format = 'Y-m-d';
    
    // -------------------------------------------------------------------------
    
    /**
    * Reading folder contents for given directory
    *
    * @param String $directory
    * 
    * @return mixed
    */
    protected static function folders($directory='')
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
    protected static function files($directory='')
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
        foreach($files as $file)
        {
            if($counter > 2)
            {
                if(stripos($file, '.'))
                {
                    $location  = 'file:///' . $directory . $file;
                    $directory = self::$directory;
                    $name      = $file;
                    $modified  = date(self::$date_format, filemtime($location));
                    $open      = '<a href="' . $location . '">' . $name . '</a><br/>';
                    
                    $data = array(
                        'open'      => $open,
                        'location'  => $location,
                        'directory' => $directory,
                        'name'      => $name,
                        'modified'  => $modified,
                    );
                    
                    array_push($arr_files, $data);
                }
            }
            
            $counter++;
        }
        
        return $arr_files;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Displaying images
    * 
    * @param Array $list
    * 
    * @return String $display
    */
    protected static function display($list)
    {
        $display = '';
        if(!empty($list))
        {
            foreach($list as $item)
            {
                $display .= '<script>window.open("' . $item['location'] . '");</script>' . PHP_EOL;
            }
        }
        
        return $display;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Listing specific directory reading results
    * 
    * @param Array $params
    * 
    * @return Array $searched || $list
    */
    public static function listing($params)
    {
        $directory  = $params['directory'];
        $method     = $params['method'];
        $print      = $params['print'];
        $display    = $params['display'];
        $delimiter  = $params['delimiter'];
        $date_start = $params['date_start'];
        $date_end   = $params['date_end'];
        
        $list = $searched = array();
        
        if(!empty($directory))
        {
            self::$directory = $directory;
        }
        
        switch($method)
        {
            case 'folders':
            {
                $list = self::folders();
            } break;
            case 'files':
            {
                $list = self::files();
            } break;
        }
        
        if(empty($delimiter))
        {
            foreach($list as $item)
            {
                $name = $item['name'];
                $date = $item['modified'];
                
                if(empty($date_start))
                {
                    array_push($searched, $item);
                }
                else if(empty($date_end))
                {
                    if($date == $date_start)
                    {
                        array_push($searched, $item);
                    }
                }
                else
                {
                    if($date >= $date_start && $date <= $date_end)
                    {
                        array_push($searched, $item);
                    }
                }
            }
        }
        else
        {
            foreach($list as $item)
            {
                $name = $item['name'];
                $date = $item['modified'];
                                
                if(stripos($name, $delimiter) !== FALSE)
                {
                    if(empty($date_start))
                    {
                        array_push($searched, $item);
                    }
                    else if(empty($date_end))
                    {
                        if($date == $date_start)
                        {
                            array_push($searched, $item);
                        }
                    }
                    else
                    {
                        if($date >= $date_start && $date <= $date_end)
                        {
                            array_push($searched, $item);
                        }
                    }
                }
            }
        }
            
        if($print || $display)
        {
            if($print)
            {
                print_r('<pre>');
                print_r($searched);
                print_r('</pre>');
            }
            else if($display)
            {
                print_r(self::display($searched));
            }
        }
        else
        {
            return $searched;
        }
    }
    
    // -------------------------------------------------------------------------
}
?>