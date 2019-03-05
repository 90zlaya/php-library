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
use PHPUnit\Framework\TestCase as Test_Case;
use PHP_Library\Core\SQL\PDO as pdo;

/**
* Testing PDO class
*/
class PDO_Test extends Test_Case {

    // -------------------------------------------------------------------------

    /**
    * PDO object data
    *
    * @var object
    */
    private $pdo_object;

    // -------------------------------------------------------------------------

    /**
    * PDO test setup method
    */
    public function setUp()
    {
        $this->pdo_object = new pdo();
    }

    // -------------------------------------------------------------------------

    /**
    * Testing get_connection method - default parameters
    */
    public function test_get_connection_method_default_parameters()
    {
        $result = $this->pdo_object->get_connection();

        $this->assertNotEmpty($result);

        $errors = $this->pdo_object->get_error();

        $this->assertInternalType('array', $errors);
        $this->assertEmpty($errors);

        $has_errors = $this->pdo_object->has_errors();

        $this->assertInternalType('bool', $has_errors);
        $this->assertFalse($has_errors);
    }

    // -------------------------------------------------------------------------

    /**
    * Testing get_connection method - set parameters
    */
    public function test_get_connection_method_set_parameters()
    {
        $connection = new pdo('localhost', 'root');

        $result = $connection->get_connection();

        $this->assertNotEmpty($result);

        $errors = $connection->get_error();

        $this->assertInternalType('array', $errors);
        $this->assertEmpty($errors);

        $has_errors = $this->pdo_object->has_errors();

        $this->assertInternalType('bool', $has_errors);
        $this->assertFalse($has_errors);
    }

    // -------------------------------------------------------------------------

    /**
    * Testing get_connection method - set invalid parameters
    */
    public function test_get_connection_method_set_invalid_parameters()
    {
        $connection = new pdo('localhost', 'nonexistent', 'invalid_password');

        $result = $connection->get_connection();

        $this->assertNull($result);

        $errors = $connection->get_error();

        $this->assertInternalType('array', $errors);
        $this->assertNotEmpty($errors);

        $has_errors = $connection->has_errors();

        $this->assertInternalType('bool', $has_errors);
        $this->assertTrue($has_errors);
    }

    // -------------------------------------------------------------------------

}
