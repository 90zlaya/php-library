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
use PHPUnit\Framework\TestCase as Test_Case;
use PHP_Library\Core\Data\Validation as validation;

/**
* Testing Validation class
*/
class Validation_Test extends Test_Case {

    // -------------------------------------------------------------------------

    /**
    * Test year method for different input
    */
    public function test_year_method()
    {
        $this->assertTrue(validation::year(2017));
        $this->assertTrue(validation::year(1917));
        $this->assertFalse(validation::year(0));
        $this->assertFalse(validation::year(20018));
        $this->assertFalse(validation::year('nothing'));
    }

    // -------------------------------------------------------------------------

    /**
    * Test comma method for different input
    */
    public function test_comma_method()
    {
        $result = validation::comma('159,99');

        $this->assertInternalType('string', $result);
        $this->assertEquals('159.99', $result);

        $result = validation::comma('159.99');

        $this->assertInternalType('string', $result);
        $this->assertEquals('159.99', $result);
    }

    // -------------------------------------------------------------------------

    /**
    * Test clear_number method for different input
    */
    public function test_clear_number_method()
    {
        $result = validation::clear_number(108);

        $this->assertInternalType('int', $result);
        $this->assertEquals(108, $result);

        $result = validation::clear_number('108');

        $this->assertInternalType('int', $result);
        $this->assertEquals(108, $result);

        $result = validation::clear_number('nothing');

        $this->assertInternalType('int', $result);
        $this->assertEquals(0, $result);
    }

    // -------------------------------------------------------------------------

    /**
    * Test clear_string method for different input
    */
    public function test_clear_string_method()
    {
        $result = validation::clear_string('This is <strong>cool</strong>!');

        $this->assertInternalType('string', $result);
        $this->assertEquals('This is strongcoolstrong!', $result);

        $result = validation::clear_string('');

        $this->assertInternalType('bool', $result);
        $this->assertFalse($result);
    }

    // -------------------------------------------------------------------------

    /**
    * Test extension method for different input
    */
    public function test_extension_method()
    {
        $result = validation::extension(
            '90zlaya.jpeg',
            array('jpeg'),
            'image/jpeg',
            array('image/jpeg')
        );

        $this->assertInternalType('bool', $result);
        $this->assertTrue($result);

        $result = validation::extension(
            '90zlaya.xml',
            array(
                'jpeg',
                'png',
            )
        );

        $this->assertInternalType('bool', $result);
        $this->assertFalse($result);
    }

    // -------------------------------------------------------------------------

    /**
    * Testing rewrite and rewrite_special methods
    * for different input
    */
    public function test_rewrite_and_rewrite_special_methods()
    {
        $string = 'Ovo je test NAZIV 12  razmak 34 ima i đĐčćŠ.png';

        $ordinary = validation::rewrite($string);

        $this->assertInternalType('string', $ordinary);
        $this->assertEquals(
            'ovo_je_test_naziv_12_razmak_34_ima_i_.png',
            $ordinary
        );

        $special = validation::rewrite_special($string);

        $this->assertInternalType('string', $special);
        $this->assertEquals(
            'ovo_je_test_naziv_12_razmak_34_ima_i_djdjccs.png',
            $special
        );

        $ordinary = validation::rewrite('');
        $special  = validation::rewrite_special('');

        $this->assertFalse($ordinary);
        $this->assertFalse($special);
    }

    // -------------------------------------------------------------------------
}
