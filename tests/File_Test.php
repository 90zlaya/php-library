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
    * Parameters for image method
    *
    * @var array
    */
    private $image_params = array(
        'show'        => 'logo.png',
        'do_not_show' => 'no-background.jpg',
        'location'    => 'https://www.dis.rs/images/',
        'default'     => 'download.png',
    );

    // -------------------------------------------------------------------------

    /**
    * URL for force_download method
    *
    * @var string
    */
    private $url = 'https://www.dis.rs/images/logo.png';

    // -------------------------------------------------------------------------

    /**
    * Locations for test setup
    *
    * @var array
    */
    protected static $locations = array(
        'folder'    => 'outsource/',
        'subfolder' => 'file/',
    );

    // -------------------------------------------------------------------------

    /**
    * File parameters
    *
    * @var array
    */
    private $file = array();

    // -------------------------------------------------------------------------

    /**
    * Line to write to file
    *
    * @var string
    */
    private $line = 'Test';

    // -------------------------------------------------------------------------

    /**
    * File test setup before File
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
    * File test setup method
    */
    protected function setUp()
    {
        $this->file = array(
            'location' => realpath('outsource/file/') . DIRECTORY_SEPARATOR,
            'name'     => 'file.txt',
        );

        file::$image = array(
            'location' => $this->image_params['location'],
            'default'  => $this->image_params['default'],
        );
    }

    // -------------------------------------------------------------------------

    /**
    * File test precondition method
    */
    protected function assertPreConditions()
    {
        $this->assertDirectoryIsReadable($this->file['location']);
        $this->assertDirectoryIsWritable($this->file['location']);
    }

    // -------------------------------------------------------------------------

    /**
    * Write to file method used in testing purposes
    *
    * @return void
    */
    protected function write_to_file()
    {
        file::write_to_file(
            $this->file['location'] . $this->file['name'],
            $this->line
        );
    }

    // -------------------------------------------------------------------------

    /**
    * Testing write_to_file method
    */
    public function test_write_to_file_method()
    {
        $this->assertNull($this->write_to_file());
        $this->assertFalse(file::write_to_file(NULL, NULL));
        $this->assertNull($this->write_to_file());
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

        $result = file::read_from_file(NULL);

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
        $this->assertNull(file::force_download($this->url));
        $this->assertNull(file::force_download($this->url), FALSE);
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

        $this->assertFalse(file::write_to_file(NULL, NULL));
    }

    // -------------------------------------------------------------------------

    /**
    * Testing image method - show image
    */
    public function test_image_method_show_image()
    {
        $result = file::image($this->image_params['show']);

        $this->assertNotEmpty($result);
        $this->assertInternalType('string', $result);
        $this->assertEquals(
            $result,
            $this->image_params['location'] . $this->image_params['show']
        );
    }

    // -------------------------------------------------------------------------

    /**
    * Testing image method - do not show image
    */
    public function test_image_method_do_not_show_image()
    {
        $result = file::image($this->image_params['do_not_show']);

        $this->assertNotEmpty($result);
        $this->assertInternalType('string', $result);
        $this->assertEquals(
            $result,
            $this->image_params['location'] . $this->image_params['default']
        );
    }

    // -------------------------------------------------------------------------

    /**
    * File test tear down after File
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
