<?php
/**
* Web_Service
*
* Web service related data
*
* @package      PHP Library
* @subpackage   phplibrary
* @category     Services
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase as Test_Case;
use phplibrary\Web_Service as web_service;

/**
* Testing Web_Service class
*/
class Web_Service_Test extends Test_Case {

    // -------------------------------------------------------------------------

    /**
    * Existent URL/Webservice
    *
    * @var string
    */
    private $existent_url = 'http://www.geoplugin.net/php.gp?ip=109.93.204.177';

    // -------------------------------------------------------------------------

    /**
    * Nonexistent URL/Webservice
    *
    * @var string
    */
    private $nonexistent_url = 'https://www.example.com/null/';

    // -------------------------------------------------------------------------

    /**
    * What is expected after 200 code is passed
    * to the responce_code method
    */
    public function test_responce_code_usage_for_200()
    {
        $result = web_service::response_code(200);

        $this->assertInternalType('array', $result);
        $this->assertArrayHasKey('status', $result);
        $this->assertTrue($result['status']);
    }

    // -------------------------------------------------------------------------

    /**
    * What is expected after 400 code is passed
    * to the responce_code method
    */
    public function test_responce_code_usage_for_400()
    {
        $result = web_service::response_code(400);

        $this->assertInternalType('array', $result);
        $this->assertArrayHasKey('status', $result);
        $this->assertFalse($result['status']);
    }

    // -------------------------------------------------------------------------

    /**
    * What happens in response_body method for existent webservice
    */
    public function test_response_body_for_existent_webservice()
    {
        $result = web_service::response_body($this->existent_url);

        $this->assertNotFalse($result);
    }

    // -------------------------------------------------------------------------

    /**
    * What happens in response_body method for nonexistent webservice
    */
    public function test_response_body_for_nonexistent_webservice()
    {
        $result = web_service::response_body($this->nonexistent_url);

        $this->assertFalse($result);
    }

    // -------------------------------------------------------------------------

    /**
    * What is expected from check_file method for nonexistent file
    */
    public function test_check_file_method_for_nonexistent_file()
    {
        $result = web_service::check_file($this->nonexistent_url);

        $this->assertInternalType('array', $result);
        $this->assertArrayHasKey('status', $result);
        $this->assertArrayHasKey('code', $result);
        $this->assertFalse($result['status']);
        $this->assertContains($result['code'], array(
            404,
            0,
        ));
    }

    // -------------------------------------------------------------------------

    /**
    * Testing response method for existent webservice
    */
    public function test_response_method_for_existent_webservice()
    {
        $items = array(
            array(),
            array(
                'header'          => 0,
                'user_agent'      => 'PHP Library: Web_Service class test',
                'binary_transfer' => 1,
            ),
        );

        foreach ($items as $item)
        {
            $result = web_service::response($this->existent_url, $item);

            $this->assertNotFalse($result);
            $this->assertInternalType('string', $result);
        }
    }

    // -------------------------------------------------------------------------

    /**
    * Testing response method for nonexistent webservice
    */
    public function test_response_method_for_nonexistent_webservice()
    {
        $result = web_service::response($this->nonexistent_url);

        $this->assertFalse($result);
    }

    // -------------------------------------------------------------------------
}
