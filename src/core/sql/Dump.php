<?php
/**
* Dump
*
* Dump database from SQL server
*
* @package      PHP_Library
* @subpackage   Core
* @category     SQL
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace PHP_Library\Core\SQL;

use PHP_Library\System\Examinations\Testing as Testing;
use Exception as Exception;

/**
* Dump database from SQL server
*/
class Dump extends Testing {

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
            : $this->set_error('Set databases for dumping');
    }

    // -------------------------------------------------------------------------

    /**
    * Check if there are databases
    * set for dumping
    *
    * @return bool
    */
    private function has_databases()
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
    private function create_folders($root='dump')
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
    * Create filename for dumped file
    *
    * @param string $folder_name
    * @param string $database
    *
    * @return string $filename
    */
    private function create_filename($folder_name, $database)
    {
        $filename = '';

        $filename .= '"';
        $filename .= $folder_name;

        if ( ! $this->override)
        {
            $filename .= date('ymdHis');
            $filename .= '_-_';
        }

        $filename .= $database;
        $filename .= '.sql';
        $filename .= '"';

        return $filename;
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
    private function check_file($filename, $database)
    {
        $filename = str_replace('"', '', $filename);

        $this->set_file($filename);

        if (empty(filesize($filename)) || $this->is_being_tested())
        {
            $this->set_error(
                'Failed to dump ' .
                $database .
                ' database'
            );
        }
        else
        {
            $this->set_success(
                'Database ' .
                $database .
                ' is dumped'
            );
        }
    }

    // -------------------------------------------------------------------------

    /**
    * Execute dump command
    *
    * @param string $filename
    * @param string $database
    *
    * @return void
    */
    private function execute_command($filename, $database)
    {
        $command = '';

        $command .= '"';
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
        $this->is_function_available('exec');

        if ($this->has_databases() && ! $this->has_errors())
        {
            $this->override = $override;

            $folder_name = $this->override
                ? $this->destination
                : $this->create_folders('mysqldump');

            foreach ($this->databases as $database)
            {
                $filename = $this->create_filename($folder_name, $database);

                $this->execute_command($filename, $database);
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
