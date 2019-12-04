<?php
/**
* PDO_Connection
*
* Make PDO connection to a database
*
* @package      PHP_Library
* @subpackage   Core
* @category     SQL
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace PHP_Library\Core\SQL;

use PHP_Library\System\Associations\Connection;
use PDO;
use PDOException;

/**
* Make PDO connection to a database
*/
class PDO_Connection extends Connection {

    /* ---------------------------------------------------------------------- */

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

    /* ---------------------------------------------------------------------- */

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

    /* ---------------------------------------------------------------------- */

    /**
    * Open PDO connection
    *
    * @return void
    */
    private function open_connection()
    {
        try
        {
            $this->connection = new PDO(
                $this->connection_string(),
                $this->parameters['user'],
                $this->parameters['pass'],
                array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
                )
            );
        }
        catch (PDOException $e)
        {
            $this->set_error($e->getMessage());
        }
    }

    /* ---------------------------------------------------------------------- */
}
