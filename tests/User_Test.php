<?php
/**
* User
*
* Works with user related data
*
* @package      PHP Library
* @subpackage   phplibrary
* @category     Files
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase as Test_Case;
use phplibrary\User as user;

/**
* Testing User class
*/
class User_Test extends Test_Case {
    
    // -------------------------------------------------------------------------
    
    /**
    * Image parameters
    * 
    * @var Array
    */
    public $params = array(
        'show'        => 'background.jpg',
        'do_not_show' => 'no-background.jpg',
        'location'    => 'https://php-library.zlatanstajic.com/assets/img/',
        'default'     => 'elephpant.png',
    );
    
    // -------------------------------------------------------------------------
    
    /**
    * Image method return values
    */
    public function test_image_method()
    {
        $image = user::image(
            $this->params['show'],
            $this->params['location'],
            $this->params['default']
        );
        
        $this->assertNotEmpty($image);
        $this->assertInternalType('string', $image);
        $this->assertEquals($image, $this->params['location'] . $this->params['show']);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Image method with default image and image location
    */
    public function test_image_method_setting_default_image_and_location()
    {
        user::$image_location = $this->params['location'];
        user::$image_default  = $this->params['default'];
        
        $image = user::image($this->params['do_not_show']);
        
        $this->assertNotEmpty($image);
        $this->assertInternalType('string', $image);
        $this->assertEquals($image, $this->params['default']);
    }
    
    // -------------------------------------------------------------------------
}
