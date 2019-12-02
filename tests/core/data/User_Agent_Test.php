<?php
/**
* User_Agent
*
* Working with user agent related data
*
* @package      PHP_Library
* @subpackage   Core
* @category     Data
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase;
use PHP_Library\Core\Data\User_Agent;

/**
* Testing User_Agent class
*/
class User_Agent_Test extends TestCase {

    /* ---------------------------------------------------------------------- */

    /**
    * List of user agents
    *
    * @var array
    */
    private $user_agents = array(
        'non_mobile_crawler' => 'Googlebot-Image/1.0',
        'mobile_non_crawler' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0_3 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A432 Safari/604.1',
    );

    /* ---------------------------------------------------------------------- */

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
            $operating_systems = User_Agent::list_operating_systems($item);

            $this->assertNotEmpty($operating_systems);
            $this->assertIsArray($operating_systems);

            foreach ($operating_systems as $system)
            {
                $this->assertNotEmpty($system);
            }
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Test return value of list_browsers method
    */
    public function test_list_browsers_method()
    {
        $browsers = User_Agent::list_browsers();

        $this->assertNotEmpty($browsers);
        $this->assertIsArray($browsers);

        foreach ($browsers as $browser)
        {
            $this->assertArrayHasKey('name', $browser);
            $this->assertArrayHasKey('signature', $browser);
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Test return value of list_devices method
    */
    public function test_list_devices_method()
    {
        $devices = User_Agent::list_devices();

        $this->assertNotEmpty($devices);
        $this->assertIsArray($devices);

        foreach ($devices as $device)
        {
            $this->assertArrayHasKey('name', $device);
            $this->assertArrayHasKey('signature', $device);
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Test return value of list_crawlers method
    */
    public function test_list_crawlers_method()
    {
        $crawlers = User_Agent::list_crawlers();

        $this->assertNotEmpty($crawlers);
        $this->assertIsArray($crawlers);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing is_crawler method for two user agents
    *
    * First one is crawler, second one is real user agent
    */
    public function test_is_crawler_method()
    {
        $is_crawler = User_Agent::is_crawler(
            $this->user_agents['non_mobile_crawler']
        );

        $this->assertTrue($is_crawler);
        $this->assertIsBool($is_crawler);

        $is_crawler = User_Agent::is_crawler(
            $this->user_agents['mobile_non_crawler']
        );

        $this->assertFalse($is_crawler);
        $this->assertIsBool($is_crawler);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing is_mobile method for two user agents
    *
    * First one is mobile, second one isn't mobile
    */
    public function test_is_mobile_method()
    {
        $is_mobile = User_Agent::is_mobile(
            $this->user_agents['mobile_non_crawler']
        );

        $this->assertTrue($is_mobile);
        $this->assertIsBool($is_mobile);

        $is_mobile = User_Agent::is_mobile(
            $this->user_agents['non_mobile_crawler']
        );

        $this->assertFalse($is_mobile);
        $this->assertIsBool($is_mobile);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing detect_browser method for valid and invalid input
    */
    public function test_detect_browser_method()
    {
        $result = User_Agent::detect_browser(
            $this->user_agents['mobile_non_crawler']
        );

        $this->assertIsString($result);
        $this->assertNotEquals('', $result);
        $this->assertEquals('Safari', $result);

        $name_when_no_match = 'Unknown';
        $result             = User_Agent::detect_browser(
            $this->user_agents['non_mobile_crawler'],
            $name_when_no_match
        );

        $this->assertIsString($result);
        $this->assertEquals($name_when_no_match, $result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing detect_operating_system method
    * for valid and invalid input
    */
    public function test_detect_operating_system_method()
    {
        $result = User_Agent::detect_operating_system(
            $this->user_agents['mobile_non_crawler']
        );

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertArrayHasKey('regex', $result);
        $this->assertArrayHasKey('name', $result);
        $this->assertArrayHasKey('group', $result);
        $this->assertEquals('Mac OS X', $result['name']);
        $this->assertEquals('Macintosh', $result['group']);

        $name_when_no_match = 'Unknown';
        $result             = User_Agent::detect_operating_system(
            $this->user_agents['non_mobile_crawler'],
            $name_when_no_match
        );

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertArrayHasKey('regex', $result);
        $this->assertArrayHasKey('name', $result);
        $this->assertArrayHasKey('group', $result);
        $this->assertEquals('', $result['regex']);
        $this->assertEquals($name_when_no_match, $result['name']);
        $this->assertEquals('', $result['group']);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing detect_device method for valid and invalid input
    */
    public function test_detect_device_method()
    {
        $result = User_Agent::detect_device(
            $this->user_agents['mobile_non_crawler']
        );

        $this->assertIsString($result);
        $this->assertNotEquals('', $result);
        $this->assertEquals('iPhone', $result);

        $name_when_no_match = 'Unknown';
        $result             = User_Agent::detect_device(
            $this->user_agents['non_mobile_crawler'],
            $name_when_no_match
        );

        $this->assertIsString($result);
        $this->assertEquals($name_when_no_match, $result);
    }

    /* ---------------------------------------------------------------------- */
}
