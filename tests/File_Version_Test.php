<?php
/**
* File_Version
*
* Checking for changed files and creating file version numbers
*
* @package      PHP Library
* @subpackage   phplibrary
* @category     Files
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase as Test_Case;
use phplibrary\File_Version as file_version;

/**
* Testing File_Version class
*/
class File_Version_Test extends Test_Case {
    
    // -------------------------------------------------------------------------
    
    /**
    * Locations for test setup
    * 
    * @var Array
    */
    protected static $locations = array(
        'folder'    => 'outsource/',
        'subfolder' => 'file_version/',
    );
    
    // -------------------------------------------------------------------------
    
    /**
    * Parameters for test
    * 
    * @var Array
    */
    private $params = array();
    
    // -------------------------------------------------------------------------
    
    /**
    * File_Version test setup before class method
    */
    public static function setUpBeforeClass()
    {
        $path_to_testing_folder  = realpath(self::$locations['folder']);
        $path_to_testing_folder .= DIRECTORY_SEPARATOR;
        $path_to_testing_folder .= self::$locations['subfolder'];
        
        if ( ! file_exists($path_to_testing_folder))
        {
            mkdir($path_to_testing_folder);
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Create file version files for testing purposes
    * 
    * @return void
    */
    private function create_file_version_files()
    {
        file_version::dump(array(
            'file_names' => array(
                'log_files'    => $this->params['folders']['file_version'] . 
                    DIRECTORY_SEPARATOR .
                    $this->params['files']['files'],
                'log_versions' => $this->params['folders']['file_version'] . 
                    DIRECTORY_SEPARATOR .
                    $this->params['files']['versions'],
            ),
            'listing'    => array(
                'directory' => $this->params['folders']['directory_lister'] . DIRECTORY_SEPARATOR,
                'method'    => 'crawl',
            ),
        ));
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Unlink existent files for testing
    * 
    * @return void
    */
    private function unlink_existent_files()
    {
        $locations = array(
            $this->params['folders']['file_version'] .
            DIRECTORY_SEPARATOR .
            $this->params['files']['files'],
            
            $this->params['folders']['file_version'] .
            DIRECTORY_SEPARATOR .
            $this->params['files']['versions'],
        );
        
        foreach ($locations as $location)
        {
            if (file_exists($location))
            {
                unlink($location);
            }
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * File_Version test setup method
    */
    protected function setUp()
    {
        $this->params['folders']['file_version']     = realpath('outsource/file_version/');
        $this->params['folders']['directory_lister'] = realpath('outsource/directory_lister/');
        $this->params['files']['files']              = 'files';
        $this->params['files']['versions']           = 'versions';
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing dump method
    */
    public function test_dump_method()
    {
        $this->assertDirectoryExists($this->params['folders']['file_version']);
        $this->assertDirectoryIsWritable($this->params['folders']['file_version']);
        $this->assertDirectoryExists($this->params['folders']['directory_lister']);
        $this->assertDirectoryIsReadable($this->params['folders']['directory_lister']);
        
        $this->assertNull($this->create_file_version_files());
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing dump method file_names are not set
    */
    public function test_dump_method_file_names_are_not_set()
    {
        $this->assertNull(
            file_version::dump(array(
                'file_names' => array(),
                'listing'    => array(
                    'directory' => $this->params['folders']['directory_lister'] . DIRECTORY_SEPARATOR,
                    'method'    => 'crawl',
                ),
            ))
        );
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * File_Version test tear down method 
    */
    protected function tearDown()
    {
        $this->create_file_version_files();
        $this->unlink_existent_files();
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * File_Version test tear down after class method
    */
    public static function tearDownAfterClass()
    {
        rmdir(
            realpath(self::$locations['folder'] . self::$locations['subfolder']) .
            DIRECTORY_SEPARATOR
        );
    }
    
    // -------------------------------------------------------------------------
}
