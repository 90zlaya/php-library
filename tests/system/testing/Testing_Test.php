<?php
/**
* Testing
*
* Use when testing unreachable code
*
* @package      PHP_Library
* @subpackage   System
* @category     Testing
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase as Test_Case;
use PHP_Library\System\Testing\Testing as testing;

/**
* Testing Testing class
*/
class Testing_Test extends Test_Case {

    // -------------------------------------------------------------------------

    /**
    * Testing object data
    *
    * @var object
    */
    private $testing_object;

    // -------------------------------------------------------------------------

    /**
    * Testing test setup method
    */
    public function setUp()
    {
        $this->testing_object = new testing();
    }

    // -------------------------------------------------------------------------

    /**
    * Testing turn_on method
    */
    public function test_turn_on_method()
    {
        $result = $this->testing_object->turn_on();

        $this->assertNull($result);
    }

    // -------------------------------------------------------------------------

}
