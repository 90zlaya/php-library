<?php
/**
* Dump
*
* Dump database from SQL server
*
* @package      PHP Library
* @subpackage   phplibrary
* @category     SQL
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace phplibrary;

use Exception as Exception;

/**
* Dump operations
*/
class Dump {
    
    // -------------------------------------------------------------------------
    
    /**
    * Command for dump execution
    * 
    * @var String
    */
    private $command = 'mysqldump';
    
    // -------------------------------------------------------------------------
    
    /**
    * Destination folder for dumped files
    * 
    * @var String
    */
    private $destination = '';
    
    // -------------------------------------------------------------------------
    
    /**
    * Database connection parameters
    * 
    * @var Array
    */
    private $connection = array(
        'host'     => 'localhost',
        'username' => 'root',
        'password' => '',
    );
    
    // -------------------------------------------------------------------------
    
    /**
    * Databases for dumping
    * 
    * @var Array
    */
    private $databases = array();
    
    // -------------------------------------------------------------------------
    
    /**
    * Dump messages
    * 
    * @var Array
    */
    private $messages = array(
        'success' => array(),
        'error'   => array(),
        'file'    => array(),
    );
    
    // -------------------------------------------------------------------------
    
    /**
    * Class constructor method
    *
    * @param Array $params
    * 
    * @return void
    */
    public function __construct($params)
    {
        isset($params['command'])
            ? $this->command = $params['command']
            : NULL;
        
        isset($params['destination'])
            ? $this->destination = $params['destination']
            : NULL;
            
        isset($params['connection']['host'])
            ? $this->connection['host'] = $params['connection']['host']
            : NULL;
        
        isset($params['connection']['username'])
            ? $this->connection['username'] = $params['connection']['username']
            : NULL;
        
        isset($params['connection']['password'])
            ? $this->connection['password'] = $params['connection']['password']
            : NULL;
            
        isset($params['databases'])
            ? $this->databases = $params['databases']
            : array_push($this->messages['error'],
                'Set databases for dumping'
            );
            
        function_exists('exec')
            ? NULL
            : array_push($this->messages['error'],
                'exec function disabled in PHP'
            );
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Get class execution messages
    * 
    * @param String $type
    * 
    * @return Array $messages
    */
    public function get_messages($type='ALL')
    {
        $messages = array();
        
        switch ($type)
        {
            case 'ALL':
            {
                $messages = $this->messages;
                
                break;
            }
            case 'SUCCESS':
            {
                $messages = $this->messages['success'];
                
                break;
            }
            case 'ERROR':
            {
                $messages = $this->messages['error'];
                
                break;
            }
            case 'FILE':
            {
                $messages = $this->messages['file'];
                
                break;
            }
        }
        
        return $messages;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Check if class execution has errors
    * 
    * @return Bool
    */
    protected function has_errors()
    {
        return ! empty($this->messages['error']);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Check if there are databases 
    * set for dumping
    * 
    * @return Bool
    */
    protected function has_databases()
    {
        return ! empty($this->databases);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Creates folders in destination path
    * 
    * @param String $root
    * 
    * @return String $folder_name
    */
    protected function create_folders($root='dump')
    {
        $folder_name_root  = $this->destination;
        $folder_name_root .= $root;
        $folder_name_root .= '/';
        
        if ( ! is_dir($folder_name_root))
        {
            mkdir($folder_name_root);
        }
        
        $folder_name_root .= date('ym');
        $folder_name_root .= '/';
        
        if ( ! is_dir($folder_name_root))
        {
            mkdir($folder_name_root);
        }
        
        $folder_name  = $folder_name_root;
        $folder_name .= date('d');
        $folder_name .= '/';
        
        if ( ! is_dir($folder_name))
        {
            mkdir($folder_name);
        }
        
        return $folder_name;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Check dumped file
    * 
    * @param String $filename
    * @param String $database
    * 
    * @return void
    */
    protected function check_file($filename, $database)
    {
        $filename = str_replace('"', '', $filename);
                    
        array_push($this->messages['file'], $filename);
        
        if (empty(filesize($filename)))
        {
            array_push($this->messages['error'],
                'Failed to dump ' .
                $database .
                ' database'
            );
        }
        else
        {
            array_push($this->messages['success'],
                'Database ' .
                $database .
                ' is dumped'
            );
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * MySQL dump
    * 
    * @return Bool
    */
    public function mysql()
    {
        if ($this->has_databases() && ! $this->has_errors())
        {
            $folder_name = $this->create_folders('mysqldump');
            
            foreach ($this->databases as $database)
            {
                $filename  = '"';
                $filename .= $folder_name;
                $filename .= date('ymdHis');
                $filename .= '_-_';
                $filename .= $database;
                $filename .= '.sql';
                $filename .= '"';
                
                $command  = '"';
                $command .= $this->command;
                $command .= '" ';
                $command .= $database;
                $command .= ' --user=';
                $command .= $this->connection['username'];
                $command .= ' --password=';
                $command .= $this->connection['password'];
                $command .= ' --host=';
                $command .= $this->connection['host'];
                $command .= ' > ';
                $command .= $filename;
                
                try
                {
                    exec($command);
                    
                    $this->check_file($filename, $database);
                }
                catch (Exception $e)
                {
                    array_push($this->messages['error'], $e->getMessage());
                }
            }
            
            if ( ! $this->has_errors())
            {
                return TRUE;
            }
        }
        
        return FALSE;
    }
    
    // -------------------------------------------------------------------------
}
