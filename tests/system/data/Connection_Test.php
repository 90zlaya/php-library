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
use PHPUnit\Framework\TestCase as Test_Case;
use PHP_Library\System\Data\Connection as connection;

/**
* Testing Connection class
*/
class Connection_Test extends Test_Case {

    // -------------------------------------------------------------------------

    /**
    * Connection object data
    *
    * @var object
    */
    private $connection_object;

    // -------------------------------------------------------------------------

    /**
    * Connection test setup method
    */
    public function setUp()
    {
        $this->messages_object = new connection();
    }

    // -------------------------------------------------------------------------

    /**
    * Testing get_connection method
    */
    public function test_get_connection_method()
    {
        $result = $this->messages_object->get_connection();

        $this->assertEmpty($result);
    }

    // -------------------------------------------------------------------------

}
