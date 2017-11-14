<?php 
/*
| -------------------------------------------------------------------
| DIRECTORY LISTER
| -------------------------------------------------------------------
|
| Directory content retrieval
|
| -------------------------------------------------------------------
*/
namespace phplibrary;

class Directory_Lister {
    private static $open_inside_browser = 'file:///';
    private static $trailing_slash      = '/';
    private static $dash                = '-';
    private static $dot                 = '.';
    private static $number_of_files     = 0;
    private static $crawled             = array();
    
    protected static $directory             = '';
    protected static $date_format           = 'Y-m-d';
    protected static $time_format           = 'H:m:i';
    protected static $method_calls          = array(
        'files'    => 'files',
        'folders'  => 'folders',
        'crawl'    => 'crawl',
    );
    protected static $forbidden_characters  = array('-', '+', '!', '#', '$', '%', '&', '(', ')', '‚', '~', ':', ';');
    
    // -------------------------------------------------------------------------
    
    /**
    * Checks dates for listed directory limits
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
        $year       = $params['year'];
        
        $searched = array();
        
        if (empty($year))
        {
            $date = substr($date, 5);
        }
        else
        {
            empty($date_start) ? NULL : $date_start = $year . self::$dash . $date_start;
            empty($date_end) ? NULL : $date_end = $year . self::$dash . $date_end;
        }
        
        if (empty($date_start))
        {
            if (empty($year))
            {
                $searched = array_merge($searched, $item);
            }
            else
            {
                $date = substr($date, 0, 4);
                
                if ($date == $year)
                {
                    $searched = array_merge($searched, $item);
                }
            }
        }
        else if (empty($date_end))
        {
            if ($date == $date_start)
            {
                $searched = array_merge($searched, $item);
            }
        }
        else
        {
            if ($date >= $date_start && $date <= $date_end)
            {
                $searched = array_merge($searched, $item);
            }
        }
        
        return $searched;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Displaying images
    * 
    * @param Array $list
    * 
    * @return String $display
    */
    private static function display($list)
    {
        $display = '';
        
        if (!empty($list))
        {
            foreach ($list as $item)
            {
                $display .= '<script>window.open("' . $item['location'] . '");</script>';
            }
        }
        
        return $display;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Files and folders in depth
    * 
    * @param Array $list
    * @param Array $types
    * 
    * @return mixed
    */
    private static function depth($list, $types=array())
    {
        if (!empty($list))
        {
            $list_of_paths = $list_of_folders = $list_of_files = array();
            
            foreach ($list as $folder)
            {
                $location = $folder . self::$trailing_slash;
                
                $depth_folders = self::folders($location);
                $depth_files   = self::files($location, $types);
                
                $list_of_paths   = array_merge($list_of_paths, $depth_folders['path']);
                $list_of_folders = array_merge($list_of_folders, $depth_folders['folder']);
                $list_of_files   = array_merge($list_of_files, $depth_files);
            }
            
            return array(
                'paths'   => $list_of_paths,
                'folders' => $list_of_folders,
                'files'   => $list_of_files,
            );
        }
        
        return FALSE;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Reading folder contents for given directory
    *
    * @param String $directory
    * 
    * @return Array $data
    */
    protected static function folders($directory='')
    {
        empty($directory) ? $directory = self::$directory : self::$directory = $directory;
        
        $files = scandir($directory);
        $arr_folder = $arr_path = array();
        $counter = 1;
        foreach ($files as $folder)
        {
            $folder_first_character = substr($folder, 0, 1);
            
            if (!in_array($folder_first_character, self::$forbidden_characters))
            {
                if ($counter > 2)
                {
                    $path = $directory . $folder;
                    
                    if (is_dir($path))
                    {
                        array_push($arr_path, $path);
                        array_push($arr_folder, $folder);
                    }
                }
                
                $counter++;
            }
        }
        
        return array(
            'path'   => $arr_path,
            'folder' => $arr_folder,
        );
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Reading file contents for given directory
    *
    * @param String $directory
    * @param Array $types
    * 
    * @return Array $arr_files
    */
    protected static function files($directory='', $types=array())
    {
        empty($directory) ? $directory = self::$directory : self::$directory = $directory;
        
        $files = scandir($directory);
        $arr_files = array();
        $counter = 1;
        foreach ($files as $file)
        {
            if ($counter > 2)
            {
                if (stripos($file, '.'))
                {
                    $extension         = pathinfo($file, PATHINFO_EXTENSION);
                    $extension_lowered = strtolower($extension);
                    
                    if (empty($types) || in_array($extension_lowered, $types))
                    {
                        $path      = $directory . $file;
                        $location  = self::$open_inside_browser . $path;
                        $directory = self::$directory;
                        $date      = date(self::$date_format, @filemtime($location));
                        $time      = date(self::$time_format, @filemtime($location));
                        $open      = '<a href="' . $location . '" target="_blank">' . $file . '</a>';
                        $title     = basename($file, self::$dot . $extension);
                        
                        $data = array(
                            'open'      => $open,
                            'location'  => $location,
                            'path'      => $path,
                            'directory' => $directory,
                            'file'      => $file,
                            'title'     => $title,
                            'extension' => $extension,
                            'date'      => $date,
                            'time'      => $time,
                        );
                        
                        array_push($arr_files, $data);
                        
                        self::$number_of_files += 1;
                    }
                }
            }
            
            $counter++;
        }
        
        return $arr_files;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Listing all files inside given directory
    * 
    * @param Array $params
    * 
    * @return void
    */
    protected static function crawl($params)
    {
        isset($params['directory']) ? $directory = $params['directory'] : $directory = '';
        isset($params['types']) ? $types = $params['types'] : $types = array();
        isset($params['data']) ? $data = $params['data'] : $data = array();
        
        if (empty($data))
        {
            $list_of_paths   = array();
            $list_of_folders = self::folders($directory);
            $list_of_files   = self::files($directory, $types);
            
            $paths = $list_of_folders['path'];
            
            $depth = self::depth($paths, $types);
            
            if ($depth)
            {
                $paths = array_merge($list_of_paths, $depth['paths']);
                $files = array_merge($list_of_files, $depth['files']);
                
                self::$crawled = $files;
                
                if (empty($paths))
                {
                    return TRUE;
                }
                else
                {
                    self::crawl(array(
                        'types' => $types,
                        'data'  => array(
                            'paths' => $paths,
                            'files' => $files,
                        ),
                    ));
                }
            }
        }
        else
        {
            $paths = $data['paths'];
            $files = $data['files'];
            
            self::$crawled = $files;
            
            if (empty($paths))
            {
                return TRUE;
            }
            else
            {
                $depth = self::depth($paths, $types);
            
                if ($depth)
                {
                    $paths = $depth['paths'];
                    $files = array_merge($files, $depth['files']);
                    
                    self::$crawled = $files;
                    
                    if (empty($paths))
                    {
                        return TRUE;
                    }
                    else
                    {
                        self::crawl(array(
                            'types' => $types,
                            'data'  => array(
                                'paths' => $paths,
                                'files' => $files,
                            ),
                        ));
                    }
                }
            }
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Listing specific directory reading results
    * 
    * @param Array $params
    * 
    * @return Array $data
    */
    public static function listing($params)
    {
        $directory  = $params['directory'];
        $method     = $params['method'];
        
        isset($params['print']) ? $print = $params['print'] : $print = FALSE;
        isset($params['display']) ? $display = $params['display'] : $display = FALSE;
        isset($params['reverse']) ? $reverse = $params['reverse'] : $reverse = '';
        isset($params['delimiter']) ? $delimiter = $params['delimiter'] : $delimiter = '';
        isset($params['date_start']) ? $date_start = $params['date_start'] : $date_start = '';
        isset($params['date_end']) ? $date_end = $params['date_end'] : $date_end = '';
        isset($params['year']) ? $year = $params['year'] : $year = '';
        isset($params['types']) ? $types = $params['types'] : $types = array();
        
        $list = $searched = array();
        
        switch ($method)
        {
            case self::$method_calls['folders']:
                {
                    $list = self::folders($directory);
                } break;
            case self::$method_calls['files']:
                {
                    $list = self::files($directory, $types);
                } break;
            case self::$method_calls['crawl']:
                {
                    self::crawl(array(
                        'directory' => $directory, 
                        'types'     => $types,
                    ));
                    $list = self::$crawled;
                } break;
        }
        
        if ($method !== self::$method_calls['folders'])
        {
            if (empty($list))
            {
                return FALSE;
            }
            else
            {
                foreach ($list as $item)
                {
                    if (isset($item['date']))
                    {
                        $date = $item['date'];
                    }
                    else
                    {
                        $date = NULL;
                    }
                    
                    $params = array(
                        'item'       => $item,
                        'date'       => $date,
                        'date_start' => $date_start,
                        'date_end'   => $date_end,
                        'year'       => $year,
                    );
                    
                    if (empty($delimiter))
                    {
                        $checked = self::check_date($params);
                    }
                    else
                    {
                        if ($reverse)
                        {
                            if (stripos($item['title'], $delimiter) === FALSE)
                            {
                                $checked = self::check_date($params);
                            }
                            else
                            {
                                $checked = array();
                            }
                        }
                        else
                        {
                            if (stripos($item['title'], $delimiter) !== FALSE)
                            {
                                $checked = self::check_date($params);
                            }
                            else
                            {
                                $checked = array();
                            }
                        }
                    }
                    
                    if (!empty($checked))
                    {
                        array_push($searched, $checked);
                    }
                }
            }
        }    
        else
        {
            $searched = $list;
        }
        
        if ($print || $display)
        {
            if ($print)
            {
                print_r('<pre>');
                print_r($searched);
                print_r('</pre>');
            }
            
            if ($display)
            {
                print_r(self::display($searched));
            }
        }
        
        $searched_count = count($searched);
        
        $data = array(
            'listing' => $searched,
            'count'   => $searched_count,
            'max'     => self::$number_of_files,
        );
        
        self::$number_of_files = 0;
        
        return $data;
    }
    
    // -------------------------------------------------------------------------
}
?>