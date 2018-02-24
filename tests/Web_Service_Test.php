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
    * What happens in response_body method for nonexistent webservice
    */
    public function test_response_body_for_nonexistent_webservice()
    {
        $result = web_service::response_body('https://www.example.com/null/');
        
        $this->assertFalse($result);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * What is expected from check_file method for nonexistent file 
    */
    public function test_check_file_method_for_nonexistent_file()
    {
        $result = web_service::check_file('https://www.example.com/null/');
        
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
}
