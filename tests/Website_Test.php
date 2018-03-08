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
            'https://php-library.zlatanstajic.com/assets/img/phplibrary-icon.png'
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
    
    /**
    * Testing return value of signature method
    */
    public function test_signature_method()
    {
        $parameters = array(
            array(
                'always_made_year' => FALSE,
                'show_licence'     => FALSE,
            ),
            array(
                'always_made_year' => FALSE,
                'show_licence'     => TRUE,
            ),
            array(
                'always_made_year' => TRUE,
                'show_licence'     => FALSE,
            ),
            array(
                'always_made_year' => TRUE,
                'show_licence'     => TRUE,
            ),
        );
        
        foreach ($parameters as $parameter)
        {
            $result = $this->website_object->signature(
                $parameter['always_made_year'],
                $parameter['show_licence']
            );

            $this->assertNotEmpty($result);
            $this->assertInternalType('string', $result);
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing signature method when we 
    * only want to see always made year
    */
    public function test_signature_method_always_made_year_parameter()
    {
        $string  = 'Copyright &#169; ';
        $string .= $this->website_data['made'];
        $string .= ' | ';
        $string .= '<a href="https://www.zlatanstajic.com/" ';
        $string .= 'target="_blank">Zlatan Stajić</a>';
        
        $result = $this->website_object->signature(TRUE);
        
        $this->assertEquals($string, $result);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing signature method for years span
    */
    public function test_signature_method_for_years_span()
    {
        $string  = 'Copyright &#169; ';
        $string .= $this->website_data['made'];
        $string .= '-';
        $string .= date('Y');
        $string .= ' | ';
        $string .= '<a href="https://www.zlatanstajic.com/" ';
        $string .= 'target="_blank">Zlatan Stajić</a>';
        
        $result = $this->website_object->signature();
        
        $this->assertEquals($string, $result);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing return value of signature_hidden method
    */
    public function test_signature_hidden_method()
    {
        $result = $this->website_object->signature_hidden('english');

        $this->assertNotEmpty($result);
        $this->assertInternalType('string', $result);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing add_to_images method and return values
    * of images method and evaluating them
    */
    public function test_add_to_images_and_images_methods()
    {
        $name_nothing     = 'nothing';
        $name_php_logo    = 'php-logo';
        $name_background  = 'backgorund';
        $image_nothing    = 'http://www.example.com/nothing.png';
        $image_php_logo   = 'https://php-library.zlatanstajic.com/assets/img/elephpant.png';
        $image_background = 'https://php-library.zlatanstajic.com/assets/img/background.png';
        
        $this->website_object->add_to_images(array(
            $name_php_logo   => $image_php_logo,
            $name_background => $image_background,
        ));
        
        $this->assertNotFalse($this->website_object->images($name_php_logo));
        $this->assertNotFalse($this->website_object->images($name_background));
        $this->assertFalse($this->website_object->images($name_nothing));
        $this->assertEquals(
            $image_php_logo,
            $this->website_object->images($name_php_logo)
        );
        $this->assertEquals(
            $image_background,
            $this->website_object->images($name_background)
        );
        $this->assertNotEquals(
            $image_nothing,
            $this->website_object->images($name_nothing)
        );
        $this->assertInternalType(
            'string',
            $this->website_object->images($name_php_logo)
        );
        $this->assertInternalType(
            'string',
            $this->website_object->images($name_background)
        );
        $this->assertInternalType(
            'bool',
            $this->website_object->images($name_nothing)
        );
        
        $name_random  = 'random';
        $image_random = 'http://www.example.com/random.png';
        
        $this->website_object->add_to_images(array(
            $name_random => $image_random,
        ), TRUE);
        
        $this->assertNotFalse($this->website_object->images($name_php_logo));
        $this->assertNotFalse($this->website_object->images($name_background));
        $this->assertFalse($this->website_object->images($name_nothing));
        $this->assertNotFalse($this->website_object->images($name_random));
        $this->assertEquals(
            $image_random,
            $this->website_object->images($name_random)
        );
        $this->assertInternalType(
            'string',
            $this->website_object->images($name_random)
        );
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing add_to_creator method and return values
    * of creator method and evaluating them
    */
    public function test_add_to_creator_and_creator_methods()
    {
        $name_nothing  = 'nothing';
        $name_name     = 'name';
        $name_website  = 'website';
        $name_email    = 'email';
        $value_nothing = 'Nothing important';
        $value_name    = 'John Doe';
        $value_website = 'http://www.example.com/';
        $value_email   = 'john.doe@example.com';
        
        $this->website_object->add_to_creator(array(
            $name_name    => $value_name,
            $name_website => $value_website,
            $name_email   => $value_email,
        ));
        
        $this->assertNotFalse($this->website_object->creator($name_name));
        $this->assertNotFalse($this->website_object->creator($name_website));
        $this->assertNotFalse($this->website_object->creator($name_email));
        $this->assertFalse($this->website_object->creator($name_nothing));
        $this->assertEquals(
            $value_name,
            $this->website_object->creator($name_name)
        );
        $this->assertEquals(
            $value_website,
            $this->website_object->creator($name_website)
        );
        $this->assertEquals(
            $value_email,
            $this->website_object->creator($name_email)
        );
        $this->assertNotEquals(
            $value_nothing,
            $this->website_object->creator($name_nothing)
        );
        $this->assertInternalType(
            'string',
            $this->website_object->creator($name_name)
        );
        $this->assertInternalType(
            'string',
            $this->website_object->creator($name_website)
        );
        $this->assertInternalType(
            'string',
            $this->website_object->creator($name_email)
        );
        $this->assertInternalType(
            'bool',
            $this->website_object->creator($name_nothing)
        );
        
        $name_random  = 'random';
        $value_random = 'http://www.example.com/random.png';
        
        $this->website_object->add_to_creator(array(
            $name_random => $value_random,
        ), TRUE);
        
        $this->assertNotFalse($this->website_object->creator($name_name));
        $this->assertNotFalse($this->website_object->creator($name_website));
        $this->assertNotFalse($this->website_object->creator($name_email));
        $this->assertFalse($this->website_object->creator($name_nothing));
        $this->assertNotFalse($this->website_object->creator($name_random));
        $this->assertEquals(
            $value_random,
            $this->website_object->creator($name_random)
        );
        $this->assertInternalType(
            'string',
            $this->website_object->creator($name_random)
        );
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Test add_to_head and head methods
    */
    public function test_add_to_head_and_head_methods()
    {
        $this->website_object->add_to_head(
            array(
                array(
                    'path' => 'custom.css',
                    'type' => 'link',
                ),
                array(
                    'path' => 'body {background-color: powderblue;}',
                    'type' => 'link-custom',
                ),
                array(
                    'path' => 'https://php-library.zlatanstajic.com/assets/js/jquery.min.js',
                    'type' => 'script',
                ),
                array(
                    'path' => 'alert("Head custom script loaded");',
                    'type' => 'script-custom',
                ),
            )
        );
        
        $head = $this->website_object->head();
        
        $this->assertNotEmpty($head);
        $this->assertInternalType('string', $head);
    }
                                                                                
    // -------------------------------------------------------------------------
    
    /**
    * Test add_to_bottom and bottom methods
    */
    public function test_add_to_bottom_and_bottom_methods()
    {
        $this->website_object->add_to_bottom(
            array(
                array(
                    'path' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',
                    'type' => 'script',
                ),
                array(
                    'path' => 'alert("Bottom custom script loaded");',
                    'type' => 'script-custom',
                ),
            )
        );
        
        $bottom = $this->website_object->bottom();
        
        $this->assertNotEmpty($bottom);
        $this->assertInternalType('string', $bottom);
    }
    
    // -------------------------------------------------------------------------
}
