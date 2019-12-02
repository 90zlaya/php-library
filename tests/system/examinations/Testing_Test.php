<?php
/**
* Testing
*
* Use when testing unreachable code
*
* @package      PHP_Library
* @subpackage   System
* @category     Examinations
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase;
use PHP_Library\System\Examinations\Testing;

/**
* Testing Testing class
*/
class Testing_Test extends TestCase {

    /* ---------------------------------------------------------------------- */

    /**
    * Testing object data
    *
    * @var object
    */
    private $testing_object;

    /* ---------------------------------------------------------------------- */

    /**
    * Testing test setup method
    */
    public function setUp(): void
    {
        $this->testing_object = new Testing();
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing turn_on method
    */
    public function test_turn_on_method()
    {
        $result = $this->testing_object->turn_on();

        $this->assertNull($result);
    }

    /* ---------------------------------------------------------------------- */

}
