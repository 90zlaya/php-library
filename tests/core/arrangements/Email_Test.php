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
use PHPUnit\Framework\TestCase;
use PHP_Library\Core\Arrangements\Email;

/**
* Testing Email class
*/
class Email_Test extends TestCase {

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
        $result = Email::show($this->emails['valid']);

        $this->assertNotFalse($result);
        $this->assertIsString($result);

        $result = Email::show($this->emails['valid_uppercase']);

        $this->assertNotFalse($result);
        $this->assertIsString($result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Invalid email passed to show_method
    */
    public function test_show_method_for_invalid_email()
    {
        $result = Email::show($this->emails['invalid']);

        $this->assertFalse($result);
        $this->assertIsBool($result);

        $result = Email::show($this->emails['forbidden_client']);

        $this->assertFalse($result);
        $this->assertIsBool($result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Valid input sent to validate method
    */
    public function test_validate_method_for_valid_input()
    {
        $result = Email::validate($this->emails['valid']);

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
        $result = Email::show($this->emails['forbidden_client']);

        $this->assertFalse($result);
        $this->assertIsBool($result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Valid input sent to mailto method
    */
    public function test_mailto_method_for_valid_input()
    {
        $result = Email::mailto($this->emails['valid']);

        $this->assertNotEmpty($result);
        $this->assertIsString($result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Invalid input sent to mailto method
    */
    public function test_mailto_method_for_invalid_input()
    {
        $result = Email::mailto($this->emails['forbidden_client']);

        $this->assertFalse($result);
        $this->assertIsBool($result);
    }

    /* ---------------------------------------------------------------------- */
}
