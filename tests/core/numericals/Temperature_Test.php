<?php
/**
* Temperature
*
* Working with temperature conversions
*
* @package      PHP_Library
* @subpackage   Core
* @category     Numericals
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase as Test_Case;
use PHP_Library\Core\Numericals\Temperature as temperature;

/**
* Testing Temperature class
*/
class Temperature_Test extends Test_Case {

    /* ---------------------------------------------------------------------- */

    /**
    * Random data to pass to conversion methods
    *
    * @var string
    */
    private $non_numeric_value = 'This is definitely not numeric value!';

    /* ---------------------------------------------------------------------- */

    /**
    * Test conversion from kelvin to celsius and
    * from kelvin to fahrenheit
    */
    public function test_kelvin_method_conversions()
    {
        $kelvin_value        = 300.7;
        $celsius_expected    = 27.55;
        $fahrenheit_expected = 81.59;

        $celsius = temperature::k_to_c($kelvin_value);

        $this->assertNotFalse($celsius);
        $this->assertInternalType('array', $celsius);
        $this->assertArrayHasKey('value', $celsius);
        $this->assertArrayHasKey('signed', $celsius);
        $this->assertArrayHasKey('rounded', $celsius);
        $this->assertInternalType('float', $celsius['value']);
        $this->assertInternalType('int', $celsius['rounded']);
        $this->assertInternalType('string', $celsius['signed']);
        $this->assertEquals($celsius['value'], $celsius_expected);

        $celsius = temperature::k_to_c($this->non_numeric_value);

        $this->assertFalse($celsius);

        $fahrenheit = temperature::k_to_f($kelvin_value);

        $this->assertNotFalse($fahrenheit);
        $this->assertInternalType('array', $fahrenheit);
        $this->assertArrayHasKey('value', $fahrenheit);
        $this->assertArrayHasKey('rounded', $fahrenheit);
        $this->assertArrayHasKey('signed', $fahrenheit);
        $this->assertInternalType('float', $fahrenheit['value']);
        $this->assertInternalType('int', $fahrenheit['rounded']);
        $this->assertInternalType('string', $fahrenheit['signed']);
        $this->assertEquals($fahrenheit['value'], $fahrenheit_expected);

        $fahrenheit = temperature::k_to_f($this->non_numeric_value);

        $this->assertFalse($fahrenheit);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Test conversion from fahrenheit to celsius and
    * from fahrenheit to kelvin
    */
    public function test_fahrenheit_method_conversions()
    {
        $fahrenheit_value = 81.59;
        $celsius_expected = 27.55;
        $kelvin_expected  = 300.7;

        $celsius = temperature::f_to_c($fahrenheit_value);

        $this->assertNotFalse($celsius);
        $this->assertInternalType('array', $celsius);
        $this->assertArrayHasKey('value', $celsius);
        $this->assertArrayHasKey('rounded', $celsius);
        $this->assertArrayHasKey('signed', $celsius);
        $this->assertInternalType('float', $celsius['value']);
        $this->assertInternalType('int', $celsius['rounded']);
        $this->assertInternalType('string', $celsius['signed']);
        $this->assertEquals($celsius['value'], $celsius_expected);

        $celsius = temperature::f_to_c($this->non_numeric_value);

        $this->assertFalse($celsius);

        $kelvin = temperature::f_to_k($fahrenheit_value);

        $this->assertNotFalse($kelvin);
        $this->assertInternalType('array', $kelvin);
        $this->assertArrayHasKey('value', $kelvin);
        $this->assertArrayHasKey('rounded', $kelvin);
        $this->assertArrayHasKey('signed', $kelvin);
        $this->assertInternalType('float', $kelvin['value']);
        $this->assertInternalType('int', $kelvin['rounded']);
        $this->assertInternalType('string', $kelvin['signed']);
        $this->assertEquals($kelvin['value'], $kelvin_expected);

        $kelvin = temperature::f_to_k($this->non_numeric_value);

        $this->assertFalse($kelvin);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Test conversion from celsius to fahrenheit and
    * from celsius to kelvin
    */
    public function test_celsius_method_conversions()
    {
        $celsius_value       = 27.55;
        $fahrenheit_expected = 81.59;
        $kelvin_expected     = 300.7;

        $fahrenheit = temperature::c_to_f($celsius_value);

        $this->assertNotFalse($fahrenheit);
        $this->assertInternalType('array', $fahrenheit);
        $this->assertArrayHasKey('value', $fahrenheit);
        $this->assertArrayHasKey('rounded', $fahrenheit);
        $this->assertArrayHasKey('signed', $fahrenheit);
        $this->assertInternalType('float', $fahrenheit['value']);
        $this->assertInternalType('int', $fahrenheit['rounded']);
        $this->assertInternalType('string', $fahrenheit['signed']);
        $this->assertEquals($fahrenheit['value'], $fahrenheit_expected);

        $fahrenheit = temperature::c_to_f($this->non_numeric_value);

        $this->assertFalse($fahrenheit);

        $kelvin = temperature::c_to_k($celsius_value);

        $this->assertNotFalse($kelvin);
        $this->assertInternalType('array', $kelvin);
        $this->assertArrayHasKey('value', $kelvin);
        $this->assertArrayHasKey('rounded', $kelvin);
        $this->assertArrayHasKey('signed', $kelvin);
        $this->assertInternalType('float', $kelvin['value']);
        $this->assertInternalType('int', $kelvin['rounded']);
        $this->assertInternalType('string', $kelvin['signed']);
        $this->assertEquals($kelvin['value'], $kelvin_expected);

        $kelvin = temperature::c_to_k($this->non_numeric_value);

        $this->assertFalse($kelvin);
    }

    /* ---------------------------------------------------------------------- */
}
