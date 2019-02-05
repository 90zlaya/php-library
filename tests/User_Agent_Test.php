<?php
/**
* User_Agent
*
* Working with user agent related data
*
* @package      PHP Library
* @subpackage   phplibrary
* @category     System
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase as Test_Case;
use phplibrary\User_Agent as user_agent;

/**
* Testing User_Agent class
*/
class User_Agent_Test extends Test_Case {

    // -------------------------------------------------------------------------

    /**
    * List of user agents
    *
    * @var array
    */
    private $user_agents = array(
        'non_mobile_crawler' => 'Googlebot-Image/1.0',
        'mobile_non_crawler' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0_3 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A432 Safari/604.1',
    );

    // -------------------------------------------------------------------------

    /**
    * Test return value of list_operating_systems method
    */
    public function test_list_operating_systems_method()
    {
        $items = array(
            NULL,
            FALSE,
            TRUE,
            0,
            '',
            'TEST',
        );

        foreach ($items as $item)
        {
            $operating_systems = user_agent::list_operating_systems($item);

            $this->assertNotEmpty($operating_systems);
            $this->assertInternalType('array', $operating_systems);

            foreach ($operating_systems as $system)
            {
                $this->assertNotEmpty($system);
            }
        }
    }

    // -------------------------------------------------------------------------

    /**
    * Test return value of list_browsers method
    */
    public function test_list_browsers_method()
    {
        $browsers = user_agent::list_browsers();

        $this->assertNotEmpty($browsers);
        $this->assertInternalType('array', $browsers);

        foreach ($browsers as $browser)
        {
            $this->assertArrayHasKey('name', $browser);
            $this->assertArrayHasKey('signature', $browser);
        }
    }

    // -------------------------------------------------------------------------

    /**
    * Test return value of list_devices method
    */
    public function test_list_devices_method()
    {
        $devices = user_agent::list_devices();

        $this->assertNotEmpty($devices);
        $this->assertInternalType('array', $devices);

        foreach ($devices as $device)
        {
            $this->assertArrayHasKey('name', $device);
            $this->assertArrayHasKey('signature', $device);
        }
    }

    // -------------------------------------------------------------------------

    /**
    * Test return value of list_crawlers method
    */
    public function test_list_crawlers_method()
    {
        $crawlers = user_agent::list_crawlers();

        $this->assertNotEmpty($crawlers);
        $this->assertInternalType('array', $crawlers);
    }

    // -------------------------------------------------------------------------

    /**
    * Testing is_crawler method for two user agents
    *
    * First one is crawler, second one is real user agent
    */
    public function test_is_crawler_method()
    {
        $is_crawler = user_agent::is_crawler(
            $this->user_agents['non_mobile_crawler']
        );

        $this->assertTrue($is_crawler);
        $this->assertInternalType('bool', $is_crawler);

        $is_crawler = user_agent::is_crawler(
            $this->user_agents['mobile_non_crawler']
        );

        $this->assertFalse($is_crawler);
        $this->assertInternalType('bool', $is_crawler);
    }

    // -------------------------------------------------------------------------

    /**
    * Testing is_mobile method for two user agents
    *
    * First one is mobile, second one isn't mobile
    */
    public function test_is_mobile_method()
    {
        $is_mobile = user_agent::is_mobile(
            $this->user_agents['mobile_non_crawler']
        );

        $this->assertTrue($is_mobile);
        $this->assertInternalType('bool', $is_mobile);

        $is_mobile = user_agent::is_mobile(
            $this->user_agents['non_mobile_crawler']
        );

        $this->assertFalse($is_mobile);
        $this->assertInternalType('bool', $is_mobile);
    }

    // -------------------------------------------------------------------------

    /**
    * Testing detect_browser method for valid and invalid input
    */
    public function test_detect_browser_method()
    {
        $result = user_agent::detect_browser(
            $this->user_agents['mobile_non_crawler']
        );

        $this->assertInternalType('string', $result);
        $this->assertNotEquals('', $result);
        $this->assertEquals('Safari', $result);

        $name_when_no_match = 'Unknown';
        $result             = user_agent::detect_browser(
            $this->user_agents['non_mobile_crawler'],
            $name_when_no_match
        );

        $this->assertInternalType('string', $result);
        $this->assertEquals($name_when_no_match, $result);
    }

    // -------------------------------------------------------------------------

    /**
    * Testing detect_operating_system method
    * for valid and invalid input
    */
    public function test_detect_operating_system_method()
    {
        $result = user_agent::detect_operating_system(
            $this->user_agents['mobile_non_crawler']
        );

        $this->assertInternalType('array', $result);
        $this->assertNotEmpty($result);
        $this->assertArrayHasKey('regex', $result);
        $this->assertArrayHasKey('name', $result);
        $this->assertArrayHasKey('group', $result);
        $this->assertEquals('Mac OS X', $result['name']);
        $this->assertEquals('Macintosh', $result['group']);

        $name_when_no_match = 'Unknown';
        $result             = user_agent::detect_operating_system(
            $this->user_agents['non_mobile_crawler'],
            $name_when_no_match
        );

        $this->assertInternalType('array', $result);
        $this->assertNotEmpty($result);
        $this->assertArrayHasKey('regex', $result);
        $this->assertArrayHasKey('name', $result);
        $this->assertArrayHasKey('group', $result);
        $this->assertEquals('', $result['regex']);
        $this->assertEquals($name_when_no_match, $result['name']);
        $this->assertEquals('', $result['group']);
    }

    // -------------------------------------------------------------------------

    /**
    * Testing detect_device method for valid and invalid input
    */
    public function test_detect_device_method()
    {
        $result = user_agent::detect_device(
            $this->user_agents['mobile_non_crawler']
        );

        $this->assertInternalType('string', $result);
        $this->assertNotEquals('', $result);
        $this->assertEquals('iPhone', $result);

        $name_when_no_match = 'Unknown';
        $result             = user_agent::detect_device(
            $this->user_agents['non_mobile_crawler'],
            $name_when_no_match
        );

        $this->assertInternalType('string', $result);
        $this->assertEquals($name_when_no_match, $result);
    }

    // -------------------------------------------------------------------------
}
