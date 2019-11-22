<?php
/**
* Email
*
* Email-related operations
*
* @package      PHP_Library
* @subpackage   Core
* @category     Arrangements
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase as Test_Case;
use PHP_Library\Core\Arrangements\Email as email;

/**
* Testing Email class
*/
class Email_Test extends Test_Case {

    /* ---------------------------------------------------------------------- */

    /**
    * List of emails for testing
    *
    * @var array
    */
    private $emails = array(
        'valid'            => 'contact@zlatanstajic.com',
        'valid_uppercase'  => 'CONTACT@ZlatanStajic.com',
        'invalid'          => 'contactzlatanstajic.com',
        'forbidden_client' => 'zlatanstajic@fakeinbox.com',
    );

    /* ---------------------------------------------------------------------- */

    /**
    * Valid email passed to show_method
    */
    public function test_show_method_for_valid_email()
    {
        $result = email::show($this->emails['valid']);

        $this->assertNotFalse($result);
        $this->assertIsString($result);

        $result = email::show($this->emails['valid_uppercase']);

        $this->assertNotFalse($result);
        $this->assertIsString($result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Invalid email passed to show_method
    */
    public function test_show_method_for_invalid_email()
    {
        $result = email::show($this->emails['invalid']);

        $this->assertFalse($result);
        $this->assertIsBool($result);

        $result = email::show($this->emails['forbidden_client']);

        $this->assertFalse($result);
        $this->assertIsBool($result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Valid input sent to validate method
    */
    public function test_validate_method_for_valid_input()
    {
        $result = email::validate($this->emails['valid']);

        $this->assertNotFalse($result);
        $this->assertIsString($result);
        $this->assertEquals($result, $this->emails['valid']);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Invalid input sent to validate method
    */
    public function test_validate_method_for_invalid_input()
    {
        $result = email::show($this->emails['forbidden_client']);

        $this->assertFalse($result);
        $this->assertIsBool($result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Valid input sent to mailto method
    */
    public function test_mailto_method_for_valid_input()
    {
        $result = email::mailto($this->emails['valid']);

        $this->assertNotEmpty($result);
        $this->assertIsString($result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Invalid input sent to mailto method
    */
    public function test_mailto_method_for_invalid_input()
    {
        $result = email::mailto($this->emails['forbidden_client']);

        $this->assertFalse($result);
        $this->assertIsBool($result);
    }

    /* ---------------------------------------------------------------------- */
}
