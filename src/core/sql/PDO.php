<?php
/**
* PDO
*
* Make PDO connection to a database
*
* @package      PHP_Library
* @subpackage   Core
* @category     SQL
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace PHP_Library\Core\SQL;

use PHP_Library\System\Associations\Connection as Connection;

use PDO as PHP_PDO;
use PDOException as PHP_PDO_Exception;

/**
* Make PDO connection to a database
*/
class PDO extends Connection {

    // -------------------------------------------------------------------------

    /**
    * Constructor
    *
    * @param string $host
    * @param string $user
    * @param string $pass
    * @param string $name
    *
    * @return void
    */
    public function __construct($host='', $user='', $pass='', $name='')
    {
        $this->set_parameters($host, $user, $pass, $name);
        $this->open_connection();
    }

    // -------------------------------------------------------------------------

    /**
    * Create PDO connection string
    *
    * @return string $string
    */
    private function connection_string()
    {
        $string = '';

        $string .= "mysql:";
        $string .= "host=";
        $string .= $this->parameters['host'];
        $string .= ";";
        $string .= "dbname=";
        $string .= $this->parameters['name'];
        $string .= ";";

        return $string;
    }

    // -------------------------------------------------------------------------

    /**
    * Open PDO connection
    *
    * @return void
    */
    private function open_connection()
    {
        try
        {
            $this->connection = new PHP_PDO(
                $this->connection_string(),
                $this->parameters['user'],
                $this->parameters['pass'],
                array(
                    PHP_PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
                )
            );
        }
        catch (PHP_PDO_Exception $e)
        {
            $this->set_error($e->getMessage());
        }
    }

    // -------------------------------------------------------------------------
}
