<?php
/**
* Directory_Lister
*
* Directory content retrieval
*
* @package      PHP_Library
* @subpackage   Core
* @category     Files
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace PHP_Library\Core\Files;

/**
* Directory content retrieval
*/
class Directory_Lister {

    // -------------------------------------------------------------------------

    /**
    * Local file path prefix
    *
    * @var string
    */
    private static $open_inside_browser = 'file:///';

    // -------------------------------------------------------------------------

    /**
    * Number of files counter
    *
    * @var int
    */
    private static $number_of_files = 0;

    // -------------------------------------------------------------------------

    /**
    * Number of folders counter
    *
    * @var int
    */
    private static $number_of_folders = 0;

    // -------------------------------------------------------------------------

    /**
    * Report variable
    *
    * @var array
    */
    private static $crawled = array();

    // -------------------------------------------------------------------------

    /**
    * Directory location
    *
    * @var string
    */
    protected static $directory = '';

    // -------------------------------------------------------------------------

    /**
    * Date format
    *
    * @var string
    */
    protected static $date_format = 'Y-m-d';

    // -------------------------------------------------------------------------

    /**
    * Time format
    *
    * @var string
    */
    protected static $time_format = 'H:m:i';

    // -------------------------------------------------------------------------

    /**
    * Method calls
    *
    * @var array
    */
    protected static $method_calls = array(
        'files'   => 'files',
        'folders' => 'folders',
        'crawl'   => 'crawl',
    );

    // -------------------------------------------------------------------------

    /**
    * Forbidden characters in files
    *
    * @var array
    */
    protected static $forbidden_characters = array(
        '-',
        '+',
        '!',
        '#',
        '$',
        '%',
        '&',
        '(',
        ')',
        '‚',
        '~',
        ':',
        ';',
    );

    // -------------------------------------------------------------------------

    /**
    * Prepare date for date check
    *
    * @param array $params
    *
    * @return array $searched
    */
    private static function prepare_date($params)
    {
        $date       = $params['date'];
        $date_start = $params['date_start'];
        $date_end   = $params['date_end'];
        $years      = $params['years'];
        $item       = $params['item'];
        $searched   = $params['searched'];

        if (empty($date_start))
        {
            if (empty($years))
            {
                $searched = array_merge($searched, $item);
            }
            else
            {
                $date = substr($date, 0, 4);

                foreach ($years as $given_year)
                {
                    if ($date == $given_year)
                    {
                        $searched = array_merge($searched, $item);
                    }
                }
            }
        }
        else
        {
            if (empty($date_end))
            {
                if ($date == $date_start)
                {
                    $searched = array_merge($searched, $item);
                }
            }

            if ($date >= $date_start && $date <= $date_end)
            {
                $searched = array_merge($searched, $item);
            }
        }

        return $searched;
    }

    // -------------------------------------------------------------------------

    /**
    * Checks dates for listed directory limits
    *
    * @param array $params
    *
    * @return array $searched
    */
    private static function check_date($params)
    {
        $item       = $params['item'];
        $date       = $params['date'];
        $date_start = $params['date_start'];
        $date_end   = $params['date_end'];
        $years      = $params['years'];

        $searched = array();

        if (empty($years))
        {
            $searched = self::prepare_date(array(
                'item'       => $item,
                'date'       => substr($date, 5),
                'date_start' => $date_start,
                'date_end'   => $date_end,
                'years'      => $years,
                'searched'   => $searched,
            ));
        }
        else
        {
            foreach ($years as $given_year)
            {
                $start = empty($date_start)
                    ? ''
                    : $given_year . '-' . $date_start;

                $end = empty($date_end)
                    ? ''
                    : $given_year . '-' . $date_end;

                $searched = self::prepare_date(array(
                    'item'       => $item,
                    'date'       => $date,
                    'date_start' => $start,
                    'date_end'   => $end,
                    'years'      => $years,
                    'searched'   => $searched,
                ));
            }
        }

        return $searched;
    }

    // -------------------------------------------------------------------------

    /**
    * Displaying images
    *
    * @param array $list
    *
    * @return string $display
    */
    private static function display($list)
    {
        $display = '';

        if ( ! empty($list))
        {
            foreach ($list as $item)
            {
                $display .= '<script>window.open("';
                $display .= $item['location'];
                $display .= '");</script>';
            }
        }

        return $display;
    }

    // -------------------------------------------------------------------------

    /**
    * Files and folders in depth
    *
    * @param array $list
    * @param array $types
    *
    * @return mixed
    */
    private static function depth($list, $types=array())
    {
        if ( ! empty($list))
        {
            $list_of_paths = $list_of_folders = $list_of_files = array();

            foreach ($list as $folder)
            {
                $location = $folder . '/';

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
    * @param string $directory
    *
    * @return array $data
    */
    protected static function folders($directory='')
    {
        empty($directory) ? $directory = self::$directory : self::$directory = $directory;

        $files      = is_dir($directory) ? scandir($directory) : array();
        $arr_folder = $arr_path = array();
        $counter    = 1;

        foreach ($files as $folder)
        {
            $folder_first_character = substr($folder, 0, 1);

            if ( ! in_array($folder_first_character, self::$forbidden_characters))
            {
                if ($counter > 2)
                {
                    $path = $directory . $folder;

                    if (is_dir($path))
                    {
                        array_push($arr_path, $path);
                        array_push($arr_folder, $folder);

                        self::$number_of_folders += 1;
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
    * @param string $directory
    * @param array $types
    *
    * @return array $arr_files
    */
    protected static function files($directory='', $types=array())
    {
        $arr_files = array();

        empty($directory) ? $directory = self::$directory : self::$directory = $directory;

        if (file_exists($directory))
        {
            $files   = scandir($directory);
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
                            $date      = date(self::$date_format, filemtime($location));
                            $time      = date(self::$time_format, filemtime($location));
                            $open      = '<a href="' . $location . '" target="_blank">' . $file . '</a>';
                            $title     = basename($file, '.' . $extension);
                            $size      = filesize($location);

                            $data = array(
                                'open'      => $open,
                                'location'  => $location,
                                'path'      => $path,
                                'directory' => $directory,
                                'file'      => $file,
                                'title'     => $title,
                                'extension' => $extension,
                                'size'      => $size,
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
        }

        return $arr_files;
    }

    // -------------------------------------------------------------------------

    /**
    * Listing all files inside given directory
    *
    * @param array $params
    *
    * @return mixed
    */
    protected static function crawl($params)
    {
        $directory = isset($params['directory']) ? $params['directory'] : '';
        $types     = isset($params['types']) ? $params['types'] : array();
        $data      = isset($params['data']) ? $params['data'] : array();

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

                if ( ! empty($paths))
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

            if ( ! empty($paths))
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
                }
            }
        }
    }

    // -------------------------------------------------------------------------

    /**
    * Listing specific directory reading results
    *
    * @param array $params
    *
    * @return mixed
    */
    public static function listing($params)
    {
        $directory = $params['directory'];
        $method    = $params['method'];

        $print   = isset($params['print']) ? $params['print'] : FALSE;
        $display = isset($params['display']) ? $params['display'] : FALSE;
        $types   = isset($params['types']) ? $params['types'] : array();

        $searched = array();

        $list = self::method_to_list($method, $directory, $types);

        if ($method !== self::$method_calls['folders'])
        {
            if (empty($list))
            {
                return FALSE;
            }
            else
            {
                $searched = self::filtering_by_date($list, $params);
            }
        }
        else
        {
            $searched = $list;
        }

        self::form_of_view($searched, $print, $display);

        if (array_key_exists('folder', $searched))
        {
            $count = count($searched['folder']);
            $max   = self::$number_of_folders;
        }
        else
        {
            $count = count($searched);
            $max   = self::$number_of_files;
        }

        $data = array(
            'listing' => $searched,
            'count'   => $count,
            'max'     => $max,
        );

        self::$number_of_folders = self::$number_of_files = 0;

        return $data;
    }

    // -------------------------------------------------------------------------

    /**
    * Convert method call to list of items
    *
    * @param string $method
    * @param string $directory
    * @param array $types
    *
    * @return array
    */
    private static function method_to_list($method, $directory, $types)
    {
        switch ($method)
        {
            case self::$method_calls['folders']:
            {
                return self::folders($directory);
            }

            case self::$method_calls['files']:
            {
                return self::files($directory, $types);
            }

            case self::$method_calls['crawl']:
            {
                self::crawl(array(
                    'directory' => $directory,
                    'types'     => $types,
                ));

                return self::$crawled;
            }

            default: return array();
        }
    }

    // -------------------------------------------------------------------------

    /**
    * Form of directory listing view
    *
    * @param array $searched
    * @param bool $print
    * @param bool $display
    *
    * @return void
    */
    private static function form_of_view($searched, $print, $display)
    {
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
    }

    // -------------------------------------------------------------------------

    /**
    * Files filtering by date
    *
    * @param array $list
    * @param array $params
    *
    * @return array $searched
    */
    private static function filtering_by_date($list, $params)
    {
        $delimiter = isset($params['delimiter'])
            ? $params['delimiter']
            : FALSE;

        $reverse = isset($params['reverse'])
            ? $params['reverse']
            : FALSE;

        $date_start = isset($params['date_start'])
            ? $params['date_start']
            : FALSE;

        $date_end = isset($params['date_end'])
            ? $params['date_end']
            : FALSE;

        $years = isset($params['years'])
            ? $params['years']
            : FALSE;

        $searched = $checked = array();

        foreach ($list as $item)
        {
            $date = isset($item['date']) ? $item['date'] : NULL;

            $params = array(
                'item'       => $item,
                'date'       => $date,
                'date_start' => $date_start,
                'date_end'   => $date_end,
                'years'      => $years,
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

            if ( ! empty($checked))
            {
                array_push($searched, $checked);
            }
        }

        return $searched;
    }

    // -------------------------------------------------------------------------
}
