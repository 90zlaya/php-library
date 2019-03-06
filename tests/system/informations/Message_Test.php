<?php
/**
* Message
*
* Use when working with errors, warnings and informations
*
* @package      PHP_Library
* @subpackage   System
* @category     Informations
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase as Test_Case;
use PHP_Library\System\Informations\Message as message;

/**
* Testing Message class
*/
class Message_Test extends Test_Case {

    // -------------------------------------------------------------------------

    /**
    * Message object data
    *
    * @var object
    */
    private $message_object;

    // -------------------------------------------------------------------------

    /**
    * Message test setup method
    */
    public function setUp()
    {
        $this->message_object = new message();
    }

    // -------------------------------------------------------------------------

    /**
    * Testing get_message method
    */
    public function test_get_message_method()
    {
        $result = $this->message_object->get_message();

        $this->assertInternalType('array', $result);
        $this->assertArrayHasKey('success', $result);
        $this->assertEmpty($result['success']);
        $this->assertArrayHasKey('error', $result);
        $this->assertEmpty($result['error']);
        $this->assertArrayHasKey('file', $result);
        $this->assertEmpty($result['file']);
    }

    // -------------------------------------------------------------------------

    /**
    * Testing has_errors method
    */
    public function test_has_errors_method()
    {
        $result = $this->message_object->has_errors();

        $this->assertInternalType('bool', $result);
        $this->assertFalse($result);
    }

    // -------------------------------------------------------------------------

    /**
    * Testing rest of getters
    */
    public function test_rest_of_getters()
    {
        $results = array();

        $results[] = $this->message_object->get_success();
        $results[] = $this->message_object->get_error();
        $results[] = $this->message_object->get_file();

        foreach ($results as $result)
        {
            $this->assertInternalType('array', $result);
            $this->assertEmpty($result);
        }
    }

    // -------------------------------------------------------------------------
}
