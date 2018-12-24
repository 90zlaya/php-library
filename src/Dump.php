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
            ? $this->command
            : NULL;
        
        isset($params['destination'])
            ? $this->destination
            : NULL;
            
        isset($params['connection']['host'])
            ? $this->connection['host']
            : NULL;
        
        isset($params['connection']['username'])
            ? $this->connection['username']
            : NULL;
        
        isset($params['connection']['password'])
            ? $this->connection['password']
            : NULL;
            
        isset($params['databases'])
            ? NULL
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
        $messages = '';
        
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
        }
        
        return $messages;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Check if class execution has errors
    * 
    * @return Bool
    */
    public function has_errors()
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
}
