<?php
/**
* Web_Service
*
* Web service related data
*
* @package      PHP_Library
* @subpackage   Core
* @category     Services
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase as Test_Case;
use PHP_Library\Core\Services\Web_Service as web_service;
use PHP_Library\System\Examinations\Testing as testing;

/**
* Testing Web_Service class
*/
class Web_Service_Test extends Test_Case {

    /* ---------------------------------------------------------------------- */

    /**
    * URLs
    *
    * @var array
    */
    private $urls = array(
        'existent'    => array(
            'image' => 'http://php.net/images/logos/elephpant-running-78x48.gif',
            'get'   => 'http://www.geoplugin.net/php.gp?ip=109.93.204.177',
        ),
        'nonexistent' => array(
            'image' => 'http://php.net/images/null.png',
            'post'  => 'https://www.example.com/null/',
        ),
    );

    /* ---------------------------------------------------------------------- */

    /**
    * Web_Service object data
    *
    * @var object
    */
    private $web_service_object;

    /* ---------------------------------------------------------------------- */

    /**
    * Web_Service test setup method
    */
    public function setUp(): void
    {
        $this->web_service_object = new web_service();
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing response method - existent URL with GET
    */
    public function test_response_method_existent_url_with_get()
    {
        $this->web_service_object->set_url($this->urls['existent']['get']);

        $items = array(
            array(),
            array(
                'header'          => FALSE,
                'binary_transfer' => TRUE,
                'user_agent'      => 'PHP Library: Web_Service test',
            ),
            array(
                'return_transfer' => TRUE,
            ),
            array(
                'no_body'         => TRUE,
            ),
        );

        foreach ($items as $item)
        {
            $result = $this->web_service_object->response($item);

            $this->assertIsArray($result);

            $this->assertArrayHasKey('status', $result);
            $this->assertIsBool($result['status']);
            $this->assertTrue($result['status']);

            $this->assertArrayHasKey('code', $result);
            $this->assertIsInt($result['code']);
            $this->assertEquals(200, $result['code']);

            $this->assertArrayHasKey('response', $result);
            $this->assertIsString($result['response']);

            if (isset($item['no_body']) && $item['no_body'] === TRUE)
            {
                $this->assertEmpty($result['response']);
            }
            else
            {
                $this->assertNotEmpty($result['response']);
            }

            $errors = $this->web_service_object->get_error();

            $this->assertIsArray($errors);
            $this->assertEmpty($errors);
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing response method - nonexistent URL with data
    */
    public function test_response_method_nonexistent_url_with_data()
    {
        $this->web_service_object->set_url($this->urls['nonexistent']['post']);

        $result = $this->web_service_object->response(array(
            'data' => array(
                'username' => 'nonexistent@example.com',
                'password' => 'thereISn0n3',
            ),
        ));

        $this->assertIsArray($result);

        $this->assertArrayHasKey('status', $result);
        $this->assertIsBool($result['status']);
        $this->assertFalse($result['status']);

        $this->assertArrayHasKey('code', $result);
        $this->assertIsInt($result['code']);
        $this->assertEquals(404, $result['code']);

        $this->assertArrayHasKey('response', $result);
        $this->assertNull($result['response']);

        $errors = $this->web_service_object->get_error();

        $this->assertIsArray($errors);
        $this->assertEmpty($errors);

    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing response method - nonexistent URLs
    */
    public function test_response_method_nonexistent_urls()
    {
        foreach ($this->urls['nonexistent'] as $url)
        {
            $this->web_service_object->set_url($url);

            $result = $this->web_service_object->response();

            $this->assertIsArray($result);

            $this->assertArrayHasKey('status', $result);
            $this->assertIsBool($result['status']);
            $this->assertFalse($result['status']);

            $this->assertArrayHasKey('code', $result);
            $this->assertIsInt($result['code']);

            if ($url === $this->urls['nonexistent']['image'])
            {
                $this->assertEquals(301, $result['code']);
            }
            else
            {
                $this->assertEquals(404, $result['code']);
            }

            $this->assertArrayHasKey('response', $result);
            $this->assertIsString($result['response']);
            $this->assertNotEmpty($result['response']);

            $errors = $this->web_service_object->get_error();

            $this->assertIsArray($errors);
            $this->assertEmpty($errors);
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing response method - URL not set
    */
    public function test_response_method_url_not_set()
    {
        $result = $this->web_service_object->response();

        $this->assertIsBool($result);
        $this->assertFalse($result);

        $errors = $this->web_service_object->get_error();

        $this->assertIsArray($errors);
        $this->assertEmpty($errors);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing response method - URL passed in constructor
    */
    public function test_response_method_url_passed_in_constructor()
    {
        $web_service = new web_service($this->urls['existent']['get']);

        $result = $web_service->response();

        $this->assertIsArray($result);

        $this->assertArrayHasKey('status', $result);
        $this->assertIsBool($result['status']);
        $this->assertTrue($result['status']);

        $this->assertArrayHasKey('code', $result);
        $this->assertIsInt($result['code']);
        $this->assertEquals(200, $result['code']);

        $this->assertArrayHasKey('response', $result);
        $this->assertIsString($result['response']);
        $this->assertNotEmpty($result['response']);

        $errors = $this->web_service_object->get_error();

        $this->assertIsArray($errors);
        $this->assertEmpty($errors);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing reponse method - testing is on
    */
    public function test_response_method_testing_is_on()
    {
        $this->web_service_object->turn_on();

        $this->web_service_object->set_url($this->urls['existent']['get']);

        $result = $this->web_service_object->response();

        $this->assertIsArray($result);

        $this->assertArrayHasKey('status', $result);
        $this->assertIsBool($result['status']);
        $this->assertTrue($result['status']);

        $this->assertArrayHasKey('code', $result);
        $this->assertIsInt($result['code']);
        $this->assertEquals(200, $result['code']);

        $this->assertArrayHasKey('response', $result);
        $this->assertIsString($result['response']);
        $this->assertNotEmpty($result['response']);

        $errors = $this->web_service_object->get_error();

        $this->assertIsArray($errors);
        $this->assertEmpty($errors);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing set_url method - no passed parameter
    */
    public function test_set_url_method_no_passed_parameter()
    {
        $this->web_service_object->set_url('');

        $errors = $this->web_service_object->get_error();

        $this->assertIsArray($errors);
        $this->assertNotEmpty($errors);
    }

    /* ---------------------------------------------------------------------- */
}
