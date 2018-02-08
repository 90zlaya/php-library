<?php
/**
* User
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
    * Image method return values
    */
    public function test_image_method()
    {
        $image_show     = 'background.jpg';
        $image_location = 'https://php-library.zlatanstajic.com/assets/img/';
        $image_default  = 'elephpant.png';
        
        $image = user::image(
            $image_show,
            $image_location,
            $image_default
        );
        
        $this->assertNotEmpty($image);
        $this->assertInternalType('string', $image);
        $this->assertEquals($image, $image_location . $image_show);
        $this->assertNotEquals($image, $image_location . $image_default);
    }
    
    // -------------------------------------------------------------------------
}
