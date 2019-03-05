<?php
/**
* Connection
*
* Make connection to a database
*
* @package      PHP_Library
* @subpackage   System
* @category     Data
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace PHP_Library\System\Data;

use PHP_Library\System\Data\Messages as Messages;

/**
* Make connection to a database
*/
class Connection extends Messages {

    // -------------------------------------------------------------------------

    /**
    * Database connection
    *
    * @var object
    */
    protected $connection;

    // -------------------------------------------------------------------------

    /**
    * Database connection parameters
    *
    * @var array
    */
    protected $parameters = array(
        'host' => '',
        'user' => '',
        'pass' => '',
        'name' => '',
    );

    // -------------------------------------------------------------------------

    /**
    * Set parameters attribute
    *
    * @param string $host
    * @param string $user
    * @param string $pass
    * @param string $name
    *
    * @return void
    */
    protected function set_parameters($host, $user, $pass, $name)
    {
        empty($host)
            ? $host = 'localhost'
            : NULL;

        empty($user)
            ? $user = 'root'
            : NULL;

        $this->parameters = array(
            'host' => $host,
            'user' => $user,
            'pass' => $pass,
            'name' => $name,
        );
    }

    // -------------------------------------------------------------------------

    /**
    * Get connection to database
    *
    * @return object $this->connection
    */
    public function get_connection()
    {
        if (empty($this->connection))
        {
            $this->set_error('Connection is not opened!');
        }

        return $this->connection;
    }

    // -------------------------------------------------------------------------
}
