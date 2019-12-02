<?php
/**
* Connection
*
* Make connection to a database
*
* @package      PHP_Library
* @subpackage   System
* @category     Associations
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase;
use PHP_Library\System\Associations\Connection;

/**
* Testing Connection class
*/
class Connection_Test extends TestCase {

    /* ---------------------------------------------------------------------- */

    /**
    * Connection object data
    *
    * @var object
    */
    private $connection_object;

    /* ---------------------------------------------------------------------- */

    /**
    * Connection test setup method
    */
    public function setUp(): void
    {
        $this->connection_object = new Connection();
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing get_connection method
    */
    public function test_get_connection_method()
    {
        $result = $this->connection_object->get_connection();

        $this->assertEmpty($result);

        $errors = $this->connection_object->get_error();

        $this->assertIsArray($errors);
        $this->assertNotEmpty($errors);

        $has_errors = $this->connection_object->has_errors();

        $this->assertIsBool($has_errors);
        $this->assertTrue($has_errors);
    }

    /* ---------------------------------------------------------------------- */

}
