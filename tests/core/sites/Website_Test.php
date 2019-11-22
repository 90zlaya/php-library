<?php
/**
* Website
*
* Works with website related data
*
* @package      PHP_Library
* @subpackage   Core
* @category     Sites
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase as Test_Case;
use PHP_Library\Core\Sites\Website as website;

/**
* Testing Website class
*/
class Website_Test extends Test_Case {

    /* ---------------------------------------------------------------------- */

    /**
    * Website object data
    *
    * @var object
    */
    private $website_object;

    /* ---------------------------------------------------------------------- */

    /**
    * Website constructor data
    *
    * @var array
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

    /* ---------------------------------------------------------------------- */

    /**
    * Website test setup method
    */
    public function setUp(): void
    {
        $localhost = 'http://localhost/_develop/php-library';

        $_SERVER['HTTP_HOST'] = isset($_SERVER['HTTP_HOST'])
            ? $_SERVER['HTTP_HOST']
            : $localhost;

        $_SERVER['REQUEST_URI'] = isset($_SERVER['REQUEST_URI'])
            ? $_SERVER['REQUEST_URI']
            : $localhost;

        $_SERVER['HTTP_REFERER'] = isset($_SERVER['HTTP_REFERER'])
            ? $_SERVER['HTTP_REFERER']
            : $localhost . '/tests/Website_Test.php';

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

    /* ---------------------------------------------------------------------- */

    /**
    * Whether or not is possible to retrieve
    * properties from constructor
    */
    public function test_retrieving_website_properties()
    {
        $this->assertArrayHasKey('location', $this->website_object->get_server());
        $this->assertArrayHasKey('referer', $this->website_object->get_server());
        $this->assertArrayHasKey('host', $this->website_object->get_server());
        $this->assertArrayHasKey('uri', $this->website_object->get_server());
        $this->assertArrayHasKey('path', $this->website_object->get_server());
        $this->assertArrayHasKey('page', $this->website_object->get_server());

        $this->assertEquals($this->website_object->get_name(), $this->website_data['name']);
        $this->assertEquals($this->website_object->get_host(), $this->website_data['host']);
        $this->assertEquals($this->website_object->get_made(), $this->website_data['made']);
        $this->assertEquals($this->website_object->get_language(), $this->website_data['language']);
        $this->assertEquals($this->website_object->get_charset(), $this->website_data['charset']);
        $this->assertEquals($this->website_object->get_description(), $this->website_data['description']);
        $this->assertEquals($this->website_object->get_keywords(), $this->website_data['keywords']);

        $this->assertIsString($this->website_object->get_name());
        $this->assertIsString($this->website_object->get_host());
        $this->assertIsString($this->website_object->get_made());
        $this->assertIsString($this->website_object->get_language());
        $this->assertIsString($this->website_object->get_charset());
        $this->assertIsString($this->website_object->get_description());
        $this->assertIsString($this->website_object->get_keywords());
        $this->assertIsArray($this->website_object->get_server());

        $errors = $this->website_object->get_error();

        $this->assertEmpty($errors);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing public properties of class
    * after instantiating empty website object
    */
    public function test_empty_website_object_public_properties()
    {
        $website = new website(array());

        $errors = $website->get_error();

        $this->assertIsArray($errors);

        $this->assertIsArray($website->get_server());

        $this->assertNotEmpty($errors);
        $this->assertNotEmpty($website->get_server());

        $this->assertEmpty($website->get_name());
        $this->assertEmpty($website->get_host());
        $this->assertEmpty($website->get_made());
        $this->assertEquals($website->get_language(), 'EN');
        $this->assertEquals($website->get_charset(), 'UTF-8');
        $this->assertEquals($website->get_description(), 'Simple website');
        $this->assertEquals($website->get_keywords(), 'simple, website');
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing image_size method with existent image
    */
    public function test_image_size_method_with_existent_image()
    {
        $image  = 'https://camo.githubusercontent.com/b4c7dde9d26720006785acf';
        $image .= '5423a7b5348d03a46/68747470733a2f2f7068702d6c6962726172792e';
        $image .= '7a6c6174616e7374616a69632e636f6d2f6173736574732f696d672f70';
        $image .= '68706c6962726172792d6c6f676f2d626c75652e706e673f636c656172';
        $image .= '5f63616368653d31';

        $result = $this->website_object->image_size($image);

        $this->assertNotFalse($result);
        $this->assertIsArray($result);

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

    /* ---------------------------------------------------------------------- */

    /**
    * Testing image_size method with nonexistent image
    */
    public function test_image_size_method_with_nonexistent_image()
    {
        $result = $this->website_object->image_size(
            'https://www.example.com/elephpant.png'
        );

        $this->assertFalse($result);
        $this->assertIsBool($result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing return value of meta method
    */
    public function test_meta_method()
    {
        $items = array(
            NULL,
            array(),
            array(
                'title'                    => 'PHP Library',
                'shortcut_icon'            => 'phplibrary-icon.png',
                'touch_icon'               => 'phplibrary-logo-blue.png',
                'google_site_verification' => '123456789abcdefghijklmn',
            ),
        );

        foreach ($items as $item)
        {
            $result = $this->website_object->meta($item);

            $this->assertNotEmpty($result);
            $this->assertIsString($result);
        }
    }

    /* ---------------------------------------------------------------------- */

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
            $this->assertIsString($result);
        }
    }

    /* ---------------------------------------------------------------------- */

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

    /* ---------------------------------------------------------------------- */

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

    /* ---------------------------------------------------------------------- */

    /**
    * Testing return value of signature_hidden method
    */
    public function test_signature_hidden_method()
    {
        $items = array(
            'english',
            'EN',
            'serbian',
            'SR',
            '',
            NULL,
        );

        foreach ($items as $item)
        {
            $result = $this->website_object->signature_hidden($item);

            $this->assertNotEmpty($result);
            $this->assertIsString($result);
        }
    }

    /* ---------------------------------------------------------------------- */

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
        $this->assertIsString($this->website_object->images($name_php_logo));
        $this->assertIsString($this->website_object->images($name_background));
        $this->assertIsBool($this->website_object->images($name_nothing));

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
        $this->assertIsString($this->website_object->images($name_random));
    }

    /* ---------------------------------------------------------------------- */

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
        $this->assertIsString($this->website_object->creator($name_name));
        $this->assertIsString($this->website_object->creator($name_website));
        $this->assertIsString($this->website_object->creator($name_email));
        $this->assertIsBool($this->website_object->creator($name_nothing));

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
        $this->assertIsString($this->website_object->creator($name_random));
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Test add_to_head and head methods
    */
    public function test_add_to_head_and_head_methods()
    {
        $items = array(
            NULL,
            array(),
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
            ),
        );

        foreach ($items as $item)
        {
            $this->website_object->add_to_head($item);
            $head = $this->website_object->head();

            $this->assertNotEmpty($head);
            $this->assertIsString($head);
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Test add_to_bottom and bottom methods
    */
    public function test_add_to_bottom_and_bottom_methods()
    {
        $items = array(
            NULL,
            array(),
            array(
                array(
                    'path' => 'https://php-library.zlatanstajic.com/assets/css/style.css',
                    'type' => 'link',
                ),
                array(
                    'path' => '<style>background: red;</style>',
                    'type' => 'link-custom',
                ),
                array(
                    'path' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',
                    'type' => 'script',
                ),
                array(
                    'path' => 'alert("Bottom custom script loaded");',
                    'type' => 'script-custom',
                ),
            ),
        );

        foreach ($items as $item)
        {
            $this->website_object->add_to_bottom($item);
            $bottom = $this->website_object->bottom();

            $this->assertNotEmpty($bottom);
            $this->assertIsString($bottom);
        }
    }

    /* ---------------------------------------------------------------------- */
}
