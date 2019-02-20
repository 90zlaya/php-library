<?php
/**
* Dump
*
* Dump database from SQL server
*
* @package      PHP_Library
* @subpackage   League
* @category     SQL
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace PHP_Library\League\SQL;

use Exception as Exception;

/**
* Dump operations
*/
class Dump {

    // -------------------------------------------------------------------------

    /**
    * Set to TRUE if being tested
    *
    * @var bool
    */
    public $testing = FALSE;

    // -------------------------------------------------------------------------

    /**
    * Command for dump execution
    *
    * @var string
    */
    private $command = 'mysqldump';

    // -------------------------------------------------------------------------

    /**
    * Destination folder for dumped files
    *
    * @var string
    */
    private $destination = '';

    // -------------------------------------------------------------------------

    /**
    * Override dumped files in destination folder
    *
    * @var bool
    */
    private $override = FALSE;

    // -------------------------------------------------------------------------

    /**
    * Database connection parameters
    *
    * @var array
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
    * @var array
    */
    private $databases = array();

    // -------------------------------------------------------------------------

    /**
    * Dump messages
    *
    * @var array
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
    * @param array $params
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
    }

    // -------------------------------------------------------------------------

    /**
    * Get execution messages
    *
    * @param string $type
    *
    * @return array $messages
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
    * Check if execution has errors
    *
    * @return bool
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
    * @return bool
    */
    protected function has_databases()
    {
        return ! empty($this->databases);
    }

    // -------------------------------------------------------------------------

    /**
    * Creates folders in destination path
    *
    * @param string $root
    *
    * @return string $folder_name
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
    * @param string $filename
    * @param string $database
    *
    * @return void
    */
    protected function check_file($filename, $database)
    {
        $filename = str_replace('"', '', $filename);

        array_push($this->messages['file'], $filename);

        if (empty(filesize($filename)) || $this->testing)
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
    * @param bool $override
    *
    * @return bool
    */
    public function mysql($override=FALSE)
    {
        $this->override = $override;

        if ( ! function_exists('exec') || $this->testing)
        {
            array_push($this->messages['error'],
                'exec function disabled in PHP'
            );

            if ($this->testing)
            {
                array_pop($this->messages['error']);
            }
        }

        if ($this->has_databases() && ! $this->has_errors())
        {
            if ($this->override)
            {
                $folder_name = $this->destination;
            }
            else
            {
                $folder_name = $this->create_folders('mysqldump');
            }

            foreach ($this->databases as $database)
            {
                $filename  = '"';
                $filename .= $folder_name;

                if ( ! $this->override)
                {
                    $filename .= date('ymdHis');
                    $filename .= '_-_';
                }

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

                exec($command);

                $this->check_file($filename, $database);
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
