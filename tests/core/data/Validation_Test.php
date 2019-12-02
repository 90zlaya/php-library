<?php
/**
* Validation
*
* Validation methods
*
* @package      PHP_Library
* @subpackage   Core
* @category     Data
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase;
use PHP_Library\Core\Data\Validation;

/**
* Testing Validation class
*/
class Validation_Test extends TestCase {

    /* ---------------------------------------------------------------------- */

    /**
    * Test year method for different input
    */
    public function test_year_method()
    {
        $this->assertTrue(Validation::year(2017));
        $this->assertTrue(Validation::year(1917));
        $this->assertFalse(Validation::year(0));
        $this->assertFalse(Validation::year(20018));
        $this->assertFalse(Validation::year('nothing'));
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Test comma method for different input
    */
    public function test_comma_method()
    {
        $result = Validation::comma('159,99');

        $this->assertIsString($result);
        $this->assertEquals('159.99', $result);

        $result = Validation::comma('159.99');

        $this->assertIsString($result);
        $this->assertEquals('159.99', $result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Test clear_number method for different input
    */
    public function test_clear_number_method()
    {
        $result = Validation::clear_number(108);

        $this->assertIsInt($result);
        $this->assertEquals(108, $result);

        $result = Validation::clear_number('108');

        $this->assertIsInt($result);
        $this->assertEquals(108, $result);

        $result = Validation::clear_number('nothing');

        $this->assertIsInt($result);
        $this->assertEquals(0, $result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Test clear_string method for different input
    */
    public function test_clear_string_method()
    {
        $result = Validation::clear_string('This is <strong>cool</strong>!');

        $this->assertIsString($result);
        $this->assertEquals('This is strongcoolstrong!', $result);

        $result = Validation::clear_string('');

        $this->assertIsBool($result);
        $this->assertFalse($result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Test extension method for different input
    */
    public function test_extension_method()
    {
        $result = Validation::extension(
            '90zlaya.jpeg',
            array('jpeg'),
            'image/jpeg',
            array('image/jpeg')
        );

        $this->assertIsBool($result);
        $this->assertTrue($result);

        $result = Validation::extension(
            '90zlaya.xml',
            array(
                'jpeg',
                'png',
            )
        );

        $this->assertIsBool($result);
        $this->assertFalse($result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing rewrite and rewrite_special methods
    * for different input
    */
    public function test_rewrite_and_rewrite_special_methods()
    {
        $string = 'Ovo je test NAZIV 12  razmak 34 ima i đĐčćŠ.png';

        $ordinary = Validation::rewrite($string);

        $this->assertIsString($ordinary);
        $this->assertEquals(
            'ovo_je_test_naziv_12_razmak_34_ima_i_.png',
            $ordinary
        );

        $special = Validation::rewrite_special($string);

        $this->assertIsString($special);
        $this->assertEquals(
            'ovo_je_test_naziv_12_razmak_34_ima_i_djdjccs.png',
            $special
        );

        $ordinary = Validation::rewrite('');
        $special  = Validation::rewrite_special('');

        $this->assertFalse($ordinary);
        $this->assertFalse($special);
    }

    /* ---------------------------------------------------------------------- */
}
