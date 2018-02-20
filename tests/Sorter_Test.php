<?php
/**
* Sorter
*
* Sortes files to multiple folders
*
* @package      PHP Library
* @subpackage   phplibrary
* @category     Sort
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase as Test_Case;
use phplibrary\Sorter as sorter;

/**
* Testing Sorter class
*/
class Sorter_Test extends Test_Case {
    
    // -------------------------------------------------------------------------
    
    /**
    * Test deploy method for existent parameters
    * 
    * Check paths to folders because they might not 
    * exist on your development environment,
    * thus not working as expected.
    */
    public function test_deploy_method_for_existent_parameters()
    {
        $sorter = new sorter();
        $report = $sorter->deploy(array(
            'where_to_read_files'         => __DIR__ . '../../outsource/sorter/source/',
            'where_to_create_directories' => __DIR__ . '../../outsource/sorter/source/',
            'number_of_directories'       => 10,
            'folder_sufix'                => '000',
            'operation'                   => 'c',
            'types'                       => array('jpg'),
        ));
        
        $this->assertNotEmpty($report);
        $this->assertInternalType('array', $report);
        $this->assertArrayHasKey('string', $report);
        $this->assertArrayHasKey('array', $report);
        $this->assertInternalType('string', $report['string']);
        $this->assertNotEmpty($report['string']);
        $this->assertArrayHasKey('usage', $report['array']);
        $this->assertArrayHasKey('result', $report['array']);
        $this->assertEmpty($report['array']['result']['errors']);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Test deploy method for nonexistent parameters
    */
    public function test_deploy_method_for_nonexistent_parameters()
    {
        $sorter = new sorter();
        $report = $sorter->deploy(array());
        
        $this->assertNotEmpty($report);
        $this->assertInternalType('array', $report);
        $this->assertArrayHasKey('string', $report);
        $this->assertArrayHasKey('array', $report);
        $this->assertInternalType('string', $report['string']);
        $this->assertNotEmpty($report['string']);
        $this->assertArrayHasKey('usage', $report['array']);
        $this->assertArrayHasKey('result', $report['array']);
        $this->assertNotEmpty($report['array']['result']['errors']);
    }
    
    // -------------------------------------------------------------------------
}
