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
use PHPUnit\Framework\TestCase;
use PHP_Library\Core\Numericals\Temperature;

/**
* Testing Temperature class
*/
class Temperature_Test extends TestCase {

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

        $celsius = Temperature::k_to_c($kelvin_value);

        $this->assertNotFalse($celsius);
        $this->assertIsArray($celsius);
        $this->assertArrayHasKey('value', $celsius);
        $this->assertArrayHasKey('signed', $celsius);
        $this->assertArrayHasKey('rounded', $celsius);
        $this->assertIsFloat($celsius['value']);
        $this->assertIsInt($celsius['rounded']);
        $this->assertIsString($celsius['signed']);
        $this->assertEquals($celsius['value'], $celsius_expected);

        $celsius = Temperature::k_to_c($this->non_numeric_value);

        $this->assertIsArray($celsius);

        $fahrenheit = Temperature::k_to_f($kelvin_value);

        $this->assertNotFalse($fahrenheit);
        $this->assertIsArray($fahrenheit);
        $this->assertArrayHasKey('value', $fahrenheit);
        $this->assertArrayHasKey('rounded', $fahrenheit);
        $this->assertArrayHasKey('signed', $fahrenheit);
        $this->assertIsFloat($fahrenheit['value']);
        $this->assertIsInt($fahrenheit['rounded']);
        $this->assertIsString($fahrenheit['signed']);
        $this->assertEquals($fahrenheit['value'], $fahrenheit_expected);

        $fahrenheit = Temperature::k_to_f($this->non_numeric_value);

        $this->assertIsArray($fahrenheit);
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

        $celsius = Temperature::f_to_c($fahrenheit_value);

        $this->assertNotFalse($celsius);
        $this->assertIsArray($celsius);
        $this->assertArrayHasKey('value', $celsius);
        $this->assertArrayHasKey('rounded', $celsius);
        $this->assertArrayHasKey('signed', $celsius);
        $this->assertIsFloat($celsius['value']);
        $this->assertIsInt($celsius['rounded']);
        $this->assertIsString($celsius['signed']);
        $this->assertEquals($celsius['value'], $celsius_expected);

        $celsius = Temperature::f_to_c($this->non_numeric_value);

        $this->assertIsArray($celsius);

        $kelvin = Temperature::f_to_k($fahrenheit_value);

        $this->assertNotFalse($kelvin);
        $this->assertIsArray($kelvin);
        $this->assertArrayHasKey('value', $kelvin);
        $this->assertArrayHasKey('rounded', $kelvin);
        $this->assertArrayHasKey('signed', $kelvin);
        $this->assertIsFloat($kelvin['value']);
        $this->assertIsInt($kelvin['rounded']);
        $this->assertIsString($kelvin['signed']);
        $this->assertEquals($kelvin['value'], $kelvin_expected);

        $kelvin = Temperature::f_to_k($this->non_numeric_value);

        $this->assertIsArray($kelvin);
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

        $fahrenheit = Temperature::c_to_f($celsius_value);

        $this->assertNotFalse($fahrenheit);
        $this->assertIsArray($fahrenheit);
        $this->assertArrayHasKey('value', $fahrenheit);
        $this->assertArrayHasKey('rounded', $fahrenheit);
        $this->assertArrayHasKey('signed', $fahrenheit);
        $this->assertIsFloat($fahrenheit['value']);
        $this->assertIsInt($fahrenheit['rounded']);
        $this->assertIsString($fahrenheit['signed']);
        $this->assertEquals($fahrenheit['value'], $fahrenheit_expected);

        $fahrenheit = Temperature::c_to_f($this->non_numeric_value);

        $this->assertIsArray($fahrenheit);

        $kelvin = Temperature::c_to_k($celsius_value);

        $this->assertNotFalse($kelvin);
        $this->assertIsArray($kelvin);
        $this->assertArrayHasKey('value', $kelvin);
        $this->assertArrayHasKey('rounded', $kelvin);
        $this->assertArrayHasKey('signed', $kelvin);
        $this->assertIsFloat($kelvin['value']);
        $this->assertIsInt($kelvin['rounded']);
        $this->assertIsString($kelvin['signed']);
        $this->assertEquals($kelvin['value'], $kelvin_expected);

        $kelvin = Temperature::c_to_k($this->non_numeric_value);

        $this->assertIsArray($kelvin);
    }

    /* ---------------------------------------------------------------------- */
}
