<?php
/**
* Geo_Plugin
*
* Geography location and other server and browser
* data collected from visitor
*
* @package      PHP_Library
* @subpackage   League
* @category     Data
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase as Test_Case;
use PHP_Library\League\Data\Geo_Plugin as geo_plugin;

/**
* Testing Geo_Plugin class
*/
class Geo_Plugin_Test extends Test_Case {

    // -------------------------------------------------------------------------

    /**
    * What is expected from data method
    */
    public function test_data_method_return_values()
    {
        $geo_plugin = new geo_plugin();

        $localhost = 'http://localhost/_develop/php-library';

        $_SERVER['HTTPS'] = isset($_SERVER['HTTPS'])
            ? $_SERVER['HTTPS']
            : $localhost;

        $_SERVER['HTTP_HOST'] = isset($_SERVER['HTTP_HOST'])
            ? $_SERVER['HTTP_HOST']
            : $localhost;

        $_SERVER['REQUEST_URI'] = isset($_SERVER['REQUEST_URI'])
            ? $_SERVER['REQUEST_URI']
            : $localhost;

        $_SERVER['HTTP_REFERER'] = isset($_SERVER['HTTP_REFERER'])
            ? $_SERVER['HTTP_REFERER']
            : $localhost . '/tests/Geo_Plugin_Test.php';

        $_SERVER['HTTP_USER_AGENT'] = isset($_SERVER['HTTP_USER_AGENT'])
            ? $_SERVER['HTTP_USER_AGENT']
            : 'Geo_Plugin_Test for bit.ly/php-library';

        $_SERVER['REMOTE_ADDR'] = isset($_SERVER['REMOTE_ADDR'])
            ? $_SERVER['REMOTE_ADDR']
            : '127.0.0.1';

        $this->assertEmpty($geo_plugin->code);

        $data = $geo_plugin->data();

        $this->assertNotEmpty($data);
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('base', $data);
        $this->assertArrayHasKey('server', $data);
        $this->assertArrayHasKey('geo', $data);
        $this->assertNotEmpty($data['base']);
        $this->assertNotEmpty($data['server']);
        $this->assertNotEmpty($data['geo']);

        $base_keys = array(
            'location',
            'referer',
            'prefix',
            'host',
            'path',
            'page',
            'date',
            'time',
            'agent',
            'address',
        );

        foreach ($base_keys as $key)
        {
            $this->assertArrayHasKey($key, $data['base']);
        }

        $server_keys = array(
            'php_self',
            'argv',
            'argc',
            'gateway_interface',
            'server_addr',
            'server_name',
            'server_software',
            'server_protocol',
            'request_method',
            'request_time',
            'request_time_float',
            'query_string',
            'document_root',
            'http_accept',
            'http_accept_charset',
            'http_accept_encoding',
            'http_accept_language',
            'http_connection',
            'http_host',
            'http_referer',
            'http_user_agent',
            'https',
            'remote_addr',
            'remote_host',
            'remote_port',
            'remote_user',
            'redirect_remote_user',
            'script_filename',
            'server_admin',
            'server_port',
            'server_signature',
            'path_translated',
            'script_name',
            'request_uri',
            'php_auth_digest',
            'php_auth_user',
            'php_auth_pw',
            'auth_type',
            'path_info',
            'orig_path_info',
        );

        foreach ($server_keys as $key)
        {
            $this->assertArrayHasKey($key, $data['server']);
        }

        $this->assertArrayHasKey('geoplugin_status', $data['geo']);
        $this->assertNotEmpty($data['geo']['geoplugin_status']);
        $this->assertEquals($geo_plugin->code, $data['geo']['geoplugin_status']);
    }

    // -------------------------------------------------------------------------

    /**
    * Valid IP is sent to geo_information method
    */
    public function test_geo_information_method_with_ip_address()
    {
        $valid_ip_address = '109.93.204.177';

        $geo_plugin = new geo_plugin();

        $this->assertEmpty($geo_plugin->code);

        $result = $geo_plugin->geo_information($valid_ip_address);

        $this->assertNotEmpty($geo_plugin->code);
        $this->assertEquals($geo_plugin->code, 200);
        $this->assertEquals($result['geoplugin_request'], $valid_ip_address);
    }

    // -------------------------------------------------------------------------

    /**
    * No IP sent to geo_information method, which is not
    * how this method should be used
    */
    public function test_geo_information_method_without_ip_address()
    {
        $geo_plugin = new geo_plugin();

        $this->assertEmpty($geo_plugin->code);

        $result = $geo_plugin->geo_information();

        $this->assertArrayHasKey('geoplugin_status', $result);
        $this->assertNotEmpty($result['geoplugin_status']);
        $this->assertNotEmpty($geo_plugin->code);
        $this->assertContains($geo_plugin->code, array(
            200,
            206,
        ));
    }

    // -------------------------------------------------------------------------
}
