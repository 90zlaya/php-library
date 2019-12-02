<?php
/**
* File
*
* File-related operations
*
* @package      PHP_Library
* @subpackage   Core
* @category     Files
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase;
use PHP_Library\Core\Files\File;

/**
* Testing File class
*/
class File_Test extends TestCase {

    /* ---------------------------------------------------------------------- */

    /**
    * Parameters for image method
    *
    * @var array
    */
    private $image_params = array(
        'show'        => 'phplibrary-icon.png',
        'do_not_show' => 'no-background.jpg',
        'location'    => 'https://raw.githubusercontent.com/php-library-league/assets/1.0.0/img/',
        'default'     => 'phplibrary-logo-blue.png',
    );

    /* ---------------------------------------------------------------------- */

    /**
    * Locations for test setup
    *
    * @var array
    */
    protected static $locations = array(
        'folder'    => 'outsource/',
        'subfolder' => 'file/',
    );

    /* ---------------------------------------------------------------------- */

    /**
    * File parameters
    *
    * @var array
    */
    private $file = array();

    /* ---------------------------------------------------------------------- */

    /**
    * Line to write to file
    *
    * @var string
    */
    private $line = 'Test';

    /* ---------------------------------------------------------------------- */

    /**
    * File test setup before File
    */
    public static function setUpBeforeClass(): void
    {
        $path_to_testing_folder  = realpath(self::$locations['folder']);
        $path_to_testing_folder .= DIRECTORY_SEPARATOR;
        $path_to_testing_folder .= self::$locations['subfolder'];

        if ( ! file_exists($path_to_testing_folder))
        {
            mkdir($path_to_testing_folder);
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
    * File test setup method
    */
    protected function setUp(): void
    {
        $this->file = array(
            'location' => realpath('outsource/file/') . DIRECTORY_SEPARATOR,
            'name'     => 'file.txt',
        );

        File::$image = array(
            'location' => $this->image_params['location'],
            'default'  => $this->image_params['default'],
        );
    }

    /* ---------------------------------------------------------------------- */

    /**
    * File test precondition method
    */
    protected function assertPreConditions(): void
    {
        $this->assertDirectoryIsReadable($this->file['location']);
        $this->assertDirectoryIsWritable($this->file['location']);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Write to file method used in testing purposes
    *
    * @return void
    */
    protected function write_to_file()
    {
        File::write_to_file(
            $this->file['location'] . $this->file['name'],
            $this->line
        );
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing write_to_file method
    */
    public function test_write_to_file_method()
    {
        $this->assertNull($this->write_to_file());
        $this->assertFalse(File::write_to_file(NULL, NULL));
        $this->assertNull($this->write_to_file());
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing read_from_file method
    */
    public function test_read_from_file_method()
    {
        $result = File::read_from_file(
            $this->file['location'] . $this->file['name']
        );

        $this->assertEquals($this->line, $result);

        $result = File::read_from_file(NULL);

        $this->assertFalse($result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing read_file_contents method
    */
    public function test_read_file_contents_method()
    {
        $result = File::read_file_contents(
            $this->file['location'] . $this->file['name']
        );

        $this->assertIsArray($result);
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

    /* ---------------------------------------------------------------------- */

    /**
    * Testing force_download method
    */
    public function test_force_download_method()
    {
        $this->assertNull(File::force_download(
            $this->image_params['location'] .
            $this->image_params['show']
        ));
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing write_to_file method when no file is present
    */
    public function test_write_to_file_method_when_no_file_is_present()
    {
        unlink(realpath($this->file['location'] . $this->file['name']));

        $result = File::write_to_file(
            $this->file['location'] . $this->file['name'],
            $this->line
        );

        $this->assertNotNull($result);
        $this->assertIsInt($result);

        $this->assertFalse(File::write_to_file(NULL, NULL));
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing image method - show image
    */
    public function test_image_method_show_image()
    {
        $result = File::image($this->image_params['show']);

        $this->assertNotEmpty($result);
        $this->assertIsString($result);
        $this->assertEquals(
            $result,
            $this->image_params['location'] . $this->image_params['show']
        );
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing image method - do not show image
    */
    public function test_image_method_do_not_show_image()
    {
        $result = File::image($this->image_params['do_not_show']);

        $this->assertNotEmpty($result);
        $this->assertIsString($result);
        $this->assertEquals(
            $result,
            $this->image_params['location'] . $this->image_params['default']
        );
    }

    /* ---------------------------------------------------------------------- */

    /**
    * File test tear down after File
    */
    public static function tearDownAfterClass(): void
    {
        $file_directory  = realpath(self::$locations['folder']);
        $file_directory .= DIRECTORY_SEPARATOR;
        $file_directory .= self::$locations['subfolder'];
        $file_document   = 'file.txt';

        unlink($file_directory . $file_document);
        rmdir($file_directory);
    }

    /* ---------------------------------------------------------------------- */
}
