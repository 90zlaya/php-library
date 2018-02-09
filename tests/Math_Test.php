<?php
/**
* Math
*
* Mathematical operations and calculations
*
* @package      PHP Library
* @subpackage   phplibrary
* @category     Math
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase as Test_Case;
use phplibrary\Math as math;

/**
* Testing Math class
*/
class Math_Test extends Test_Case {
    
    // -------------------------------------------------------------------------
    
    /**
    * Expected behavior of iterate method and iterator variable
    * in Math class
    */
    public function test_iterator_variable_and_iterate_method()
    {
        $this->assertEmpty(math::$iterator);
        $this->assertInternalType('int', math::$iterator);
        
        for ($i=0; $i<10; $i++)
        {
            $number = math::iterate();
            
            $this->assertEquals($number, $i+1);
        }
        
        $this->assertNotEmpty(math::$iterator);
        
        math::iterate(TRUE);
        
        $this->assertEquals(math::$iterator, 1);
        $this->assertInternalType('int', math::$iterator);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Expected behavior of even_or_odd method and bool variable
    * in Math class
    */
    public function test_bool_variable_and_even_or_odd_method()
    {
        $parameter_one = 'first';
        $parameter_two = 'second';
        
        for ($i=0; $i<10; $i++)
        {
            $string = math::even_or_odd($parameter_one, $parameter_two);
            
            $this->assertInternalType('string', $string);
            $this->assertNotEmpty($string);
            
            if ($i % 2 == 0)
            {
                $this->assertEquals($string, $parameter_one);
                $this->assertNotEquals($string, $parameter_two);
            }
            else
            {
                $this->assertNotEquals($string, $parameter_one);
                $this->assertEquals($string, $parameter_two);
            }
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Expected behavior of percentage method
    */
    public function test_percentage_method()
    {
        $expected_value = 60;
        
        $percentage = math::percentage(30, 50);
        
        $this->assertInternalType('array', $percentage);
        $this->assertArrayHasKey('value', $percentage);
        $this->assertArrayHasKey('sign', $percentage);
        
        $this->assertInternalType('int', $percentage['value']);
        $this->assertInternalType('string', $percentage['sign']);
        
        $this->assertEquals($percentage['value'], $expected_value);
        $this->assertEquals($percentage['sign'], $expected_value . '%');
    }
    
    // -------------------------------------------------------------------------
}
