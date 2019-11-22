<?php
/**
* Math
*
* Mathematical operations and calculations
*
* @package      PHP_Library
* @subpackage   Core
* @category     Numericals
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase as Test_Case;
use PHP_Library\Core\Numericals\Math as math;

/**
* Testing Math class
*/
class Math_Test extends Test_Case {

    /* ---------------------------------------------------------------------- */

    /**
    * Testing iterate method
    */
    public function test_iterate_method()
    {
        for ($i=0; $i<10; $i++)
        {
            $number = math::iterate();

            $this->assertEquals($i+1, $number);
        }

        $number = math::iterate(TRUE);

        $this->assertIsInt($number);
        $this->assertEquals(1, $number);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing iterate method - getters and setters
    */
    public function test_iterate_method_getters_and_setters()
    {
        math::set_iterator();

        $iterator = math::get_iterator();

        $this->assertIsInt($iterator);
        $this->assertEmpty($iterator);

        $new_value = 15;

        math::set_iterator($new_value);

        $iterator = math::get_iterator();

        $this->assertIsInt($iterator);
        $this->assertEquals($new_value, $iterator);


    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing even_or_odd method
    */
    public function test_even_or_odd_method()
    {
        $parameter_one = 'first';
        $parameter_two = 'second';

        for ($i=0; $i<10; $i++)
        {
            $string = math::even_or_odd($parameter_one, $parameter_two);

            $this->assertIsString($string);
            $this->assertNotEmpty($string);

            if ($i % 2 == 0)
            {
                $this->assertEquals($parameter_one, $string);
                $this->assertNotEquals($parameter_two, $string);
            }
            else
            {
                $this->assertNotEquals($parameter_one, $string);
                $this->assertEquals($parameter_two, $string);
            }
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing percentage method
    */
    public function test_percentage_method()
    {
        $expected_value = 60;

        $percentage = math::percentage(30, 50);

        $this->assertIsArray($percentage);
        $this->assertArrayHasKey('value', $percentage);
        $this->assertArrayHasKey('sign', $percentage);

        $this->assertIsInt($percentage['value']);
        $this->assertIsString($percentage['sign']);

        $this->assertEquals($expected_value, $percentage['value']);
        $this->assertEquals($expected_value . '%', $percentage['sign']);

        $percentage = math::percentage(NULL, NULL);

        $this->assertEquals(NULL, $percentage['value']);
    }

    /* ---------------------------------------------------------------------- */
}
