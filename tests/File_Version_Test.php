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
    * Testing dump method
    */
    public function test_dump_method()
    {
        $file_version_folder     = realpath('outsource/file_version/');
        $directory_lister_folder = realpath('outsource/directory_lister/');
        
        $this->assertDirectoryExists($file_version_folder);
        $this->assertDirectoryIsWritable($file_version_folder);
        $this->assertDirectoryExists($directory_lister_folder);
        $this->assertDirectoryIsReadable($directory_lister_folder);
        
        $this->assertNull(
            file_version::dump(array(
                'file_names' => array(
                    'log_files'    => $file_version_folder . 
                        DIRECTORY_SEPARATOR .
                        'files',
                    'log_versions' => $file_version_folder . 
                        DIRECTORY_SEPARATOR .
                        'versions',
                ),
                'listing'    => array(
                    'directory'  => $directory_lister_folder . 
                        DIRECTORY_SEPARATOR,
                    'method'     => 'crawl',
                ),
            ))
        );
    }
    
    // -------------------------------------------------------------------------
}
