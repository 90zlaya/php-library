<?php
/**
* Random
*
* Random-related data
*
* @package      PHP Library
* @subpackage   phplibrary
* @category     Data
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase as Test_Case;
use phplibrary\Random as random;

/**
* Testing Random class
*/
class Random_Test extends Test_Case {
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing element method with multidimensional array
    */
    public function test_element_method_multidimensional_array()
    {
        $list = array(
            array(
                'content'     => "Monday: There's no place like home!",
                'description' => "Tweet",
                'url'         => "https://mobile.twitter.com/elonmusk/status/730592699011604481",
                'attributes'  => "_blank",
            ),
            array(
                'content'     => "Tuesday: There's no place like home!",
                'description' => "Tweet",
                'url'         => "https://mobile.twitter.com/elonmusk/status/730592699011604481",
                'attributes'  => "_blank",
            ),
            array(
                'content'     => "Wednesday: There's no place like home!",
                'description' => "Tweet",
                'url'         => "https://mobile.twitter.com/elonmusk/status/730592699011604481",
                'attributes'  => "_blank",
            ),
            array(
                'content'     => "Thursday: There's no place like home!",
                'description' => "Tweet",
                'url'         => "https://mobile.twitter.com/elonmusk/status/730592699011604481",
                'attributes'  => "_blank",
            ),
            array(
                'content'     => "Friday: There's no place like home!",
                'description' => "Tweet",
                'url'         => "https://mobile.twitter.com/elonmusk/status/730592699011604481",
                'attributes'  => "_blank",
            ),
            array(
                'content'     => "Saturday: There's no place like home!",
                'description' => "Tweet",
                'url'         => "https://mobile.twitter.com/elonmusk/status/730592699011604481",
                'attributes'  => "_blank",
            ),
            array(
                'content'     => "Sunday: There's no place like home!",
                'description' => "Tweet",
                'url'         => "https://mobile.twitter.com/elonmusk/status/730592699011604481",
                'attributes'  => "_blank",
            ),
        );
        
        $types = array(
            '',
            'DAY',
            'MONTH',
        );
        
        foreach ($types as $type)
        {
            $result = random::element($list, $type);
        
            $this->assertNotEmpty($result);
            $this->assertInternalType('array', $result);
            
            foreach ($list as $item)
            {
                $this->assertArrayHasKey(key($item), $result);
            }
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing element method with onedimensional array
    */
    public function test_element_method_onedimensional_array()
    {
        $list = array();
        
        for ($i=0; $i<31; $i++)
        {
            $list = array_merge($list, array('element ' . $i));
        }
        
        $types = array(
            '',
            'DAY',
            'MONTH',
        );
        
        foreach ($types as $type)
        {
            $result = random::element($list, $type);
            
            $this->assertNotEmpty($result);
            $this->assertInternalType('string', $result);
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing generate method for valid input
    */
    public function test_generate_method_for_valid_input()
    {
        $types = array(
            'INT',
            'STRING',
            'STRING_ADVANCED',
        );
        
        foreach ($types as $type)
        {
            $result = random::generate(5, $type);
        
            $this->assertNotEmpty($result);
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing generate method for invalid input
    */
    public function test_generate_method_for_invalid_input()
    {
        $calls = array(
            array(
                'length' => 5,
                'type'   => 'void',
            ),
            array(
                'length' => "test",
                'type'   => '',
            ),
            array(
                'length' => 0,
                'type'   => '',
            ),
        );
        
        foreach ($calls as $call)
        {
            $result = random::generate($call['length'], $call['type']);
            
            $this->assertFalse($result);
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing break_caching method
    */
    public function test_break_caching_method()
    {
        $result = random::break_caching();
        
        $this->assertNotFalse($result);
        $this->assertNotEmpty($result);
        $this->assertInternalType('string', $result);
    }
    
    // -------------------------------------------------------------------------
}
