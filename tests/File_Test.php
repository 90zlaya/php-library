<?php
/**
* File
*
* File-related operations
*
* @package      PHP Library
* @subpackage   phplibrary
* @category     Files
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase as Test_Case;
use phplibrary\File as file;

/**
* Testing File class
*/
class File_Test extends Test_Case {
    
    // -------------------------------------------------------------------------
    
    /**
    * Locations for test setup
    * 
    * @var Array
    */
    protected static $locations = array(
        'folder'    => 'outsource/',
        'subfolder' => 'file/',
    );
    
    // -------------------------------------------------------------------------
    
    /**
    * File parameters
    * 
    * @var Array
    */
    private $file = array();
    
    // -------------------------------------------------------------------------
    
    /**
    * Line to write to file
    * 
    * @var String
    */
    private $line = 'Test';
    
    // -------------------------------------------------------------------------
    
    /**
    * File test setup before class method
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
    * File_Test setup method
    */
    protected function setUp()
    {
        $this->file = array(
            'location' => realpath('outsource/file/') . DIRECTORY_SEPARATOR,
            'name'     => 'file.txt',
        );
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * File_Test precondition method
    */
    protected function assertPreConditions()
    {
        $this->assertDirectoryIsReadable($this->file['location']);
        $this->assertDirectoryIsWritable($this->file['location']);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing write_to_file method
    */
    public function test_write_to_file_method()
    {
        $this->assertNull(file::write_to_file(
            $this->file['location'] . $this->file['name'],
            $this->line
        ));
        
        $this->assertFalse(file::write_to_file('', ''));
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing read_from_file method
    */
    public function test_read_from_file_method()
    {
        $result = file::read_from_file(
            $this->file['location'] . $this->file['name']
        );
        
        $this->assertEquals($this->line, $result);
        
        $result = file::read_from_file('');
        
        $this->assertFalse($result);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing read_file_contents method
    */
    public function test_read_file_contents_method()
    {
        $result = file::read_file_contents(
            $this->file['location'] . $this->file['name']
        );
        
        $this->assertInternalType('array', $result);
        $this->assertArrayHasKey('status', $result);
        $this->assertArrayHasKey('items', $result);
        $this->assertTrue($result['status']);
        
        foreach ($result['items'] as $item)
        {
            $this->assertContains($item[0], array(
                $this->line . "\r\n",
                $this->line . "\n",
            ));
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing force_download method
    */
    public function test_force_download_method()
    {
        $this->assertNull(file::force_download(
            'php-library.jpg',
            'https://link.zlatanstajic.com/images/portfolio/'
        ));
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing write_to_file method when no file is present
    */
    public function test_write_to_file_method_when_no_file_is_present()
    {
        unlink(realpath($this->file['location'] . $this->file['name']));
        
        $this->assertNull(file::write_to_file(
            $this->file['location'] . $this->file['name'],
            $this->line
        ));
        
        $this->assertFalse(file::write_to_file('', ''));
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * File test tear down after class method
    */
    public static function tearDownAfterClass()
    {
        $file_directory  = realpath(self::$locations['folder']);
        $file_directory .= DIRECTORY_SEPARATOR;
        $file_directory .= self::$locations['subfolder'];
        $file_document   = 'file.txt';
        
        unlink($file_directory . $file_document);
        rmdir($file_directory);
    }
    
    // -------------------------------------------------------------------------
}
