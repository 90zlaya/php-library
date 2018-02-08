<?php
/**
* File_Version
*
* Checking for changed files and creating file version numbers
*
* @package      PHP Library
* @subpackage   phplibrary
* @category     Files
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace phplibrary;

use phplibrary\File as file;
use phplibrary\Directory_Lister as directory_lister;

/**
* Checking for changed files and creating file version numbers
*/
class File_Version {
    
    // -------------------------------------------------------------------------
    
    /**
    * First version value to start with
    */
    const FIRST_VERSION = '1.0.0';
    
    // -------------------------------------------------------------------------
    
    /**
    * Names of files to be created to store data
    * 
    * @var Array
    */
    protected static $file_names = array(
        'log_files'     => 'files',
        'log_versions'  => 'versions',
    );
    
    // -------------------------------------------------------------------------
        
    /**
    * Default date format
    * 
    * @var String
    */
    protected static $date_format = 'Y-m-d';
    
    // -------------------------------------------------------------------------
    
    /**
    * Dump files
    * 
    * @param Array $params
    * 
    * @return void
    */
    public static function dump($params)
    {
        isset($params['file_names']['log_files']) 
            ? self::$file_names['log_files'] = $params['file_names']['log_files'] 
            : NULL;
        
        isset($params['file_names']['log_versions']) 
            ? self::$file_names['log_versions'] = $params['file_names']['log_versions'] 
            : NULL;
        
        $read_data = self::read_data();
        
        self::create_files(
            self::write_data(
                $params['listing'], 
                substr($read_data['data'], 0, 10)
            ), 
            $read_data['is_new'], 
            substr($read_data['data'], 11)
        );
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Read data from file
    * 
    * @param Bool $is_new
    * 
    * @return Array
    */
    private static function read_data($is_new=FALSE)
    {
        $data = file::read_from_file(self::$file_names['log_files']);
        
        if (empty($data))
        {
            $is_new = TRUE;
            
            file::write_to_file(
                self::$file_names['log_files'], 
                date(self::$date_format) . ' ' . self::FIRST_VERSION
            );
        }
        
        return array(
            'is_new' => $is_new,
            'data'   => $data,
        );
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Prepare data to write to file
    * 
    * @param Array $listing_params
    * @param String $data_date
    * 
    * @return String $write_data
    */
    private static function write_data($listing_params, $data_date)
    {
        $write_data = '';
        
        if ( ! empty($listing_params) && ! empty($data_date))
        {
            $listing = directory_lister::listing($listing_params)['listing'];
            
            foreach ($listing as $item)
            {
                $path = $item['path'];
                $date = $item['date'];
                
                if ($date > $data_date && $data_date !== date(self::$date_format))
                {
                    $write_data .= $path . PHP_EOL;
                }
            }
        }
        
        return $write_data;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Create files 
    * 
    * @param String $write_data
    * @param Bool $is_new
    * @param String $data_version
    * 
    * @return void
    */
    private static function create_files($write_data, $is_new, $data_version)
    {
        if ( ! empty($write_data))
        {
            if ($is_new)
            {
                $latest_version = self::FIRST_VERSION;
            }
            else
            {
                $latest_version_root   = substr($data_version, 0, 4);
                $latest_version_number = substr($data_version, -1);
                
                $latest_version_number += 1;
                
                $latest_version = $latest_version_root . $latest_version_number;
            }
            
            $write_to_log_file = date(self::$date_format) . ' ' . $latest_version;
            file::write_to_file(self::$file_names['log_files'], $write_to_log_file);
            
            $write_data = date(self::$date_format) . ' ' . $latest_version . PHP_EOL . PHP_EOL . $write_data;
            file::write_to_file(self::$file_names['log_versions'], $write_data);
        }
    }
    
    // -------------------------------------------------------------------------
}
