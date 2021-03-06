<?php
/**
* Password
*
* Works with password related data
*
* @package      PHP_Library
* @subpackage   Core
* @category     Data
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase;
use PHP_Library\Core\Data\Password;

/**
* Testing Password class
*/
class Password_Test extends TestCase {

    /* ---------------------------------------------------------------------- */

    /**
    * Data for testing password methods
    *
    * @var array
    */
    protected $password_data = array(
        'string'   => 'T3stPa$$w0r6',
        'encoded'  => 'VDNzdFBhJCR3MHI2',
        'digested' => array(
            'sha512' => '9ee343313e04a742d9f1345d87a0b5aa3fe90aba8afee4339d3da988acce62b7349d5dce1d58c091a2ae7e379e6ac0d2fc24db66371a476678b00d941223cc84',
            'sha256' => '4f2a67abe54576ac3690b78669c807053ddd82ce911f1ef39e2a093b33260ddf',
            'sha1'   => 'a15e8bf186b2711ae305382eb97bcf53dd215498',
            'md5'    => '4f809d0e0f25a98a0a6fa48b06bd5b36',
        ),
    );

    /* ---------------------------------------------------------------------- */

    /**
    * Testing encode string and decode string
    * and comparing values
    */
    public function test_encode_and_decode_methods()
    {
        $encoded = Password::encode($this->password_data['string']);
        $decoded = Password::decode($encoded);

        $this->assertNotEmpty($encoded);
        $this->assertIsString($encoded);
        $this->assertNotEmpty($decoded);
        $this->assertIsString($decoded);
        $this->assertEquals($decoded, $this->password_data['string']);
        $this->assertEquals($encoded, $this->password_data['encoded']);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing digest method - default approach
    */
    public function test_digest_method_default_approach()
    {
        $result = Password::digest($this->password_data['string']);

        $this->assertIsString($result);
        $this->assertEquals(
            $this->password_data['digested']['sha512'],
            $result
        );
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing digest method - empty input
    */
    public function test_digest_method_empty_input()
    {
        $inputs = array(
            '',
            0,
            NULL,
            FALSE,
        );

        foreach ($inputs as $input)
        {
            $result = Password::digest($input);

            $this->assertFalse($result);
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing digest method - different methods
    */
    public function test_digest_method_different_methods()
    {
        $methods = array(
            'sha512',
            'sha256',
            'sha1',
            'md5',
        );

        foreach ($methods as $method)
        {
            Password::set_method($method);

            $result = Password::digest($this->password_data['string']);

            $this->assertIsString($result);
            $this->assertNotEmpty($result);
            $this->assertNotFalse($result);

            if (array_key_exists($method, $this->password_data['digested']))
            {
                $this->assertEquals(
                    $this->password_data['digested'][$method],
                    $result
                );
            }
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing digest method - false methods
    */
    public function test_digest_method_false_methods()
    {
        $methods = array(
            'not-a-method',
            '',
            0,
            NULL,
            FALSE,
        );

        foreach ($methods as $method)
        {
            Password::set_method($method);

            $result = Password::digest($this->password_data['string']);

            $this->assertFalse($result);
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing new_readable method
    */
    public function test_new_readable_method()
    {
        $result = Password::new_readable();

        $this->assertNotEmpty($result);
        $this->assertNotFalse($result);

        $words  = 'Furnace,Benign,Rusted,One,Daybreak,Nine,';
        $words .= 'Longing,Seventeen,Homecoming,Freight Car';

        $result = Password::new_readable(1, $words);

        $this->assertNotEmpty($result);
        $this->assertNotFalse($result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing new_unreadable method
    */
    public function test_new_unreadable_method()
    {
        $result = Password::new_unreadable();

        $this->assertNotEmpty($result);
        $this->assertNotFalse($result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing strength method for various input
    */
    public function test_strength_method_for_various_input()
    {
        $result = Password::strength($this->password_data['string'], 80);

        $this->assertNotEmpty($result);
        $this->assertIsArray($result);

        $this->assertArrayHasKey('status', $result);
        $this->assertArrayHasKey('strength', $result);

        $this->assertIsBool($result['status']);
        $this->assertIsFloat($result['strength']);

        $this->assertTrue($result['status']);
        $this->assertEquals($result['strength'], 85.457395851362);
    }

    /* ---------------------------------------------------------------------- */
}
