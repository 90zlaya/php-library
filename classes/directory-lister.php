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
                    $open      = '<a href="' . $location . '" target="_blank">' . $name . '</a>';
                    
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
                $display .= '<script>window.open("' . $item[0]['location'] . '");</script>';
            }
        }
        
        return $display;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Checks dates of listed directory limits
    * 
    * @param Array $params
    * 
    * @return Array $searched
    */
    private static function check_date($params)
    {
        $item       = $params['item'];
        $date       = $params['date'];
        $date_start = $params['date_start'];
        $date_end   = $params['date_end'];
        
        $searched = array();
        
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
        
        return $searched;
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
        
        switch($method)
        {
            case 'folders':
            {
                $list = self::folders($directory);
            } break;
            case 'files':
            {
                $list = self::files($directory);
            } break;
        }
        
        foreach($list as $item)
        {
            $params = array(
                'item'       => $item,
                'date'       => $item['modified'],
                'date_start' => $date_start,
                'date_end'   => $date_end,
            );
            
            if(empty($delimiter))
            {
                $checked = self::check_date($params);
            }
            else
            {
                if(stripos($item['name'], $delimiter) !== FALSE)
                {
                    $checked = self::check_date($params);
                }
                else
                {
                    $checked = array();
                }
            }
            
            if(!empty($checked))
            {
                array_push($searched, $checked);
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
            if($display)
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