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
    * File_Test setup method
    */
    public function setUp()
    {
        $this->file = array(
            'location' => realpath('outsource/file/') . DIRECTORY_SEPARATOR,
            'name'     => 'file.txt',
        );
        
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
}
