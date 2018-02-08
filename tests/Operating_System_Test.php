<?php
/**
* Operating_System
*
* @package      PHP Library
* @subpackage   phplibrary
* @category     Data
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase as Test_Case;
use phplibrary\Operating_System as operating_system;

/**
* Testing Operating_System class
*/
class Operating_System_Test extends Test_Case {
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing return values for get_list method
    */
    public function test_operating_systems_list()
    {
        $list_of_operating_systems = operating_system::get_list();
        
        $this->assertNotEmpty($list_of_operating_systems);
        $this->assertInternalType('array', $list_of_operating_systems);
        
        foreach ($list_of_operating_systems as $item)
        {
            $this->assertInternalType('array', $item);
            $this->assertArrayHasKey('name', $item);
        }
    }
    
    // -------------------------------------------------------------------------
}
