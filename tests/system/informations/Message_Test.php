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
use PHPUnit\Framework\TestCase;
use PHP_Library\System\Informations\Message;

/**
* Testing Message class
*/
class Message_Test extends TestCase {

    /* ---------------------------------------------------------------------- */

    /**
    * Message object data
    *
    * @var object
    */
    private $message_object;

    /* ---------------------------------------------------------------------- */

    /**
    * Message test setup method
    */
    public function setUp(): void
    {
        $this->message_object = new Message();
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing get_message method
    */
    public function test_get_message_method()
    {
        $result = $this->message_object->get_message();

        $this->assertIsArray($result);
        $this->assertArrayHasKey('success', $result);
        $this->assertEmpty($result['success']);
        $this->assertArrayHasKey('error', $result);
        $this->assertEmpty($result['error']);
        $this->assertArrayHasKey('file', $result);
        $this->assertEmpty($result['file']);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing has_errors method
    */
    public function test_has_errors_method()
    {
        $result = $this->message_object->has_errors();

        $this->assertIsBool($result);
        $this->assertFalse($result);
    }

    /* ---------------------------------------------------------------------- */

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
            $this->assertIsArray($result);
            $this->assertEmpty($result);
        }
    }

    /* ---------------------------------------------------------------------- */
}
