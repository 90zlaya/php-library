<?php
/**
* Messages
*
* Use when working with errors, warnings and informations
*
* @package      PHP_Library
* @subpackage   System
* @category     Data
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase as Test_Case;
use PHP_Library\System\Data\Messages as messages;

/**
* Testing Messages class
*/
class Messages_Test extends Test_Case {

    // -------------------------------------------------------------------------

    /**
    * Messages object data
    *
    * @var object
    */
    private $messages_object;

    // -------------------------------------------------------------------------

    /**
    * Messages test setup method
    */
    public function setUp()
    {
        $this->messages_object = new messages();
    }

    // -------------------------------------------------------------------------

    /**
    * Testing get_messages method
    */
    public function test_get_messages_method()
    {
        $result = $this->messages_object->get_messages();

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
    * Testing rest of getters
    */
    public function test_rest_of_getters()
    {
        $results = array();

        $results[] = $this->messages_object->get_success();
        $results[] = $this->messages_object->get_error();
        $results[] = $this->messages_object->get_file();
        
        foreach ($results as $result)
        {
            $this->assertInternalType('array', $result);
            $this->assertEmpty($result);
        }
    }

    // -------------------------------------------------------------------------
}
