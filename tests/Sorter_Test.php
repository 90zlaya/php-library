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
use phplibrary\Directory_Lister as directory_lister;

/**
* Testing Sorter class
*/
class Sorter_Test extends Test_Case {
    
    // -------------------------------------------------------------------------
    
    /**
    * Locations for test setup
    * 
    * @var Array
    */
    protected static $locations = array(
        'folder'      => 'outsource/',
        'subfolder'   => 'sorter/',
        'destination' => 'destination/',
    );
    
    // -------------------------------------------------------------------------
    
    /**
    * Sorter test setup before class method
    */
    public static function setUpBeforeClass()
    {
        $path_to_testing_folder  = realpath(self::$locations['folder']);
        $path_to_testing_folder .= DIRECTORY_SEPARATOR;
        $path_to_testing_folder .= self::$locations['subfolder'];
        $path_to_testing_folder .= self::$locations['destination'];
        
        if ( ! file_exists($path_to_testing_folder))
        {
            mkdir($path_to_testing_folder);
        }
    }
    
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
        $where_to_read_files  = realpath('outsource/sorter/source/');
        $where_to_read_files .= DIRECTORY_SEPARATOR;
        
        $where_to_create_directories  = realpath('outsource/sorter/destination/');
        $where_to_create_directories .= DIRECTORY_SEPARATOR;
        
        $this->assertDirectoryExists($where_to_read_files);
        $this->assertDirectoryExists($where_to_create_directories);
        $this->assertDirectoryIsReadable($where_to_read_files);
        $this->assertDirectoryIsWritable($where_to_create_directories);
        
        $sorter = new sorter();
        $report = $sorter->deploy(array(
            'where_to_read_files'         => $where_to_read_files,
            'where_to_create_directories' => $where_to_create_directories,
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
    
    /**
    * Sorter test tear down after class method
    */
    public static function tearDownAfterClass()
    {
        $file_directory  = realpath(self::$locations['folder']);
        $file_directory .= DIRECTORY_SEPARATOR;
        $file_directory .= self::$locations['subfolder'];
        $file_directory .= self::$locations['destination'];
        
        $listing = directory_lister::listing(array(
            'directory'  => $file_directory,
            'method'     => 'crawl',
        ));
        
        foreach ($listing['listing'] as $item)
        {
            unlink($item['path']);
            rmdir($item['directory']);
        }
        
        rmdir($file_directory);
    }
    
    // -------------------------------------------------------------------------
}
