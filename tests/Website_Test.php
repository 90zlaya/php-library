<?php
/**
* Website_Test
*
* Use this class when working with website related data.
*
* @package      PHP Library
* @subpackage   phplibrary
* @category     Website
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase as Test_Case;
use phplibrary\Website as website;

/**
* Testing Website class
*/
class Website_Test extends Test_Case {

    // -------------------------------------------------------------------------

    /**
    * Website object data
    *
    * @var Object
    */
    private $website_object;

    // -------------------------------------------------------------------------

    /**
    * Website constructor data
    *
    * @var Array
    */
    private $website_data = array(
        'name'        => 'PHP Library',
        'host'        => 'http://localhost/_develop/php-library/',
        'made'        => '2017',
        'language'    => 'EN',
        'charset'     => 'UTF-8',
        'description' => 'PHP Library is set of classes containing most useful methods and variables for Web Development.',
        'keywords'    => 'php, library, oop, php7',
    );

    // -------------------------------------------------------------------------

    /**
    * Website test setup method
    */
    public function setUp()
    {
        $this->website_object = new website(array(
            'name'        => $this->website_data['name'],
            'host'        => $this->website_data['host'],
            'made'        => $this->website_data['made'],
            'language'    => $this->website_data['language'],
            'charset'     => $this->website_data['charset'],
            'description' => $this->website_data['description'],
            'keywords'    => $this->website_data['keywords'],
        ));
    }

    // -------------------------------------------------------------------------

    /**
    * Whether or not is possible to retrieve
    * properties from constructor
    */
    public function test_retrieving_website_properties()
    {
        $this->assertArrayHasKey('location', $this->website_object->server);
        $this->assertArrayHasKey('referer', $this->website_object->server);
        $this->assertArrayHasKey('host', $this->website_object->server);
        $this->assertArrayHasKey('uri', $this->website_object->server);
        $this->assertArrayHasKey('path', $this->website_object->server);
        $this->assertArrayHasKey('page', $this->website_object->server);

        $this->assertEquals($this->website_object->name, $this->website_data['name']);
        $this->assertEquals($this->website_object->host, $this->website_data['host']);
        $this->assertEquals($this->website_object->made, $this->website_data['made']);
        $this->assertEquals($this->website_object->language, $this->website_data['language']);
        $this->assertEquals($this->website_object->charset, $this->website_data['charset']);
        $this->assertEquals($this->website_object->description, $this->website_data['description']);
        $this->assertEquals($this->website_object->keywords, $this->website_data['keywords']);

        $this->assertInternalType('string', $this->website_object->name);
        $this->assertInternalType('string', $this->website_object->host);
        $this->assertInternalType('string', $this->website_object->made);
        $this->assertInternalType('string', $this->website_object->language);
        $this->assertInternalType('string', $this->website_object->charset);
        $this->assertInternalType('string', $this->website_object->description);
        $this->assertInternalType('string', $this->website_object->keywords);
        $this->assertInternalType('array', $this->website_object->server);

        $this->assertEmpty($this->website_object->errors);
    }

    // -------------------------------------------------------------------------

    /**
    * Testing public properties of class
    * after instantiating empty website object
    */
    public function test_empty_website_object_public_properties()
    {
        $website = new website(array());

        $this->assertInternalType('array', $website->errors);
        $this->assertInternalType('array', $website->server);

        $this->assertNotEmpty($website->errors);
        $this->assertNotEmpty($website->server);

        $this->assertEmpty($website->name);
        $this->assertEmpty($website->host);
        $this->assertEmpty($website->made);
        $this->assertEquals($website->language, 'EN');
        $this->assertEquals($website->charset, 'UTF-8');
        $this->assertEquals($website->description, 'Simple website');
        $this->assertEquals($website->keywords, 'simple, website');
    }

    // -------------------------------------------------------------------------

    /**
    * Testing image_size method with existent image
    */
    public function test_image_size_method_with_existent_image()
    {
        $result = $this->website_object->image_size(
            'https://php-library.zlatanstajic.com/assets/img/elephpant.png'
        );

        $this->assertNotFalse($result);
        $this->assertInternalType('array', $result);
        
        $values = array(
            'width',
            'height',
            'width_height',
            'type',
            'size',
            'bits',
            'mime',
        );

        foreach ($values as $value)
        {
            $this->assertArrayHasKey($value, $result);
        }
    }

    // -------------------------------------------------------------------------

    /**
    * Testing image_size method with nonexistent image
    */
    public function test_image_size_method_with_nonexistent_image()
    {
        $result = $this->website_object->image_size(
            'https://www.example.com/elephpant.png'
        );

        $this->assertFalse($result);
        $this->assertInternalType('bool', $result);
    }

    // -------------------------------------------------------------------------

    /**
    * Testing return value of meta method
    */
    public function test_meta_method()
    {
        $result = $this->website_object->meta();

        $this->assertNotEmpty($result);
        $this->assertInternalType('string', $result);
    }

    // -------------------------------------------------------------------------
}
