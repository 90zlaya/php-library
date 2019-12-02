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
use PHPUnit\Framework\TestCase;
use PHP_Library\Core\Numericals\Math;

/**
* Testing Math class
*/
class Math_Test extends TestCase {

    /* ---------------------------------------------------------------------- */

    /**
    * Testing iterate method
    */
    public function test_iterate_method()
    {
        for ($i=0; $i<10; $i++)
        {
            $number = Math::iterate();

            $this->assertEquals($i+1, $number);
        }

        $number = Math::iterate(TRUE);

        $this->assertIsInt($number);
        $this->assertEquals(1, $number);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing iterate method - getters and setters
    */
    public function test_iterate_method_getters_and_setters()
    {
        Math::set_iterator();

        $iterator = Math::get_iterator();

        $this->assertIsInt($iterator);
        $this->assertEmpty($iterator);

        $new_value = 15;

        Math::set_iterator($new_value);

        $iterator = Math::get_iterator();

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
            $string = Math::even_or_odd($parameter_one, $parameter_two);

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

        $percentage = Math::percentage(30, 50);

        $this->assertIsArray($percentage);
        $this->assertArrayHasKey('value', $percentage);
        $this->assertArrayHasKey('sign', $percentage);

        $this->assertIsInt($percentage['value']);
        $this->assertIsString($percentage['sign']);

        $this->assertEquals($expected_value, $percentage['value']);
        $this->assertEquals($expected_value . '%', $percentage['sign']);

        $percentage = Math::percentage(NULL, NULL);

        $this->assertEquals(NULL, $percentage['value']);
    }

    /* ---------------------------------------------------------------------- */
}
