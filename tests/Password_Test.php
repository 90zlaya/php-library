<?php
/**
* Password
*
* Works with password related data
*
* @package      PHP Library
* @subpackage   phplibrary
* @category     Password
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase as Test_Case;
use phplibrary\Password as password;

/**
* Testing Password class
*/
class Password_Test extends Test_Case {
    
    // -------------------------------------------------------------------------
    
    /**
    * Data for testing password methods
    * 
    * @var Array
    */
    protected $password_data = array(
        'string'  => 'T3stPa$$w0r6',
        'encoded' => 'VDNzdFBhJCR3MHI2',
    );
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing encode string and decode string
    * and comparing values
    */
    public function test_encode_and_decode_methods()
    {
        $encoded = password::encode($this->password_data['string']);
        $decoded = password::decode($encoded);
        
        $this->assertNotEmpty($encoded);
        $this->assertInternalType('string', $encoded);
        $this->assertNotEmpty($decoded);
        $this->assertInternalType('string', $decoded);
        $this->assertEquals($decoded, $this->password_data['string']);
        $this->assertEquals($encoded, $this->password_data['encoded']);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing new_readable and new_unreadable methods
    */
    public function test_new_readable_and_unreadable_method()
    {
        $result = password::new_unreadable();
        
        $this->assertNotEmpty($result);
        $this->assertNotFalse($result);
        
        $result = password::new_readable();
        
        $this->assertNotEmpty($result);
        $this->assertNotFalse($result);
        
        $words  = 'Furnace,Benign,Rusted,One,Daybreak,Nine,';
        $words .= 'Longing,Seventeen,Homecoming,Freight Car';
        
        $result = password::new_readable(1, $words);
        
        $this->assertNotEmpty($result);
        $this->assertNotFalse($result);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing strength method for various input
    */
    public function test_strength_method_for_various_input()
    {
        $result = password::strength($this->password_data['string'], 80);
        
        $this->assertNotEmpty($result);
        $this->assertInternalType('array', $result);
        
        $this->assertArrayHasKey('status', $result);
        $this->assertArrayHasKey('strength', $result);
        
        $this->assertInternalType('bool', $result['status']);
        $this->assertInternalType('float', $result['strength']);
        
        $this->assertTrue($result['status']);
        $this->assertEquals($result['strength'], 85.457395851362);
    }
    
    // -------------------------------------------------------------------------
}
