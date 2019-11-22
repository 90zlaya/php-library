<?php
/**
* Sorter
*
* Sortes files to multiple folders
*
* @package      PHP_Library
* @subpackage   Core
* @category     Files
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase as Test_Case;
use PHP_Library\Core\Files\Sorter as sorter;
use PHP_Library\Core\Files\Directory_Lister as directory_lister;

/**
* Testing Sorter class
*/
class Sorter_Test extends Test_Case {

    /* ---------------------------------------------------------------------- */

    /**
    * Parameters for test
    *
    * @var array
    */
    private $params = array();

    /* ---------------------------------------------------------------------- */

    /**
    * Locations for test setup
    *
    * @var array
    */
    protected static $locations = array(
        'folder'          => 'outsource/',
        'subfolder'       => 'sorter/',
        'destination'     => 'destination/',
        'source'          => 'source/',
        'movable'         => 'movable/',
        'movable_testing' => 'movable_testing/',
        'paths'           => array(),
    );

    /* ---------------------------------------------------------------------- */

    /**
    * Sorter test setup before Setup
    */
    public static function setUpBeforeClass()
    {
        self::$locations['paths']['source'] =
            realpath(self::$locations['folder']) .
            DIRECTORY_SEPARATOR .
            self::$locations['subfolder'] .
            self::$locations['source'];

        self::$locations['paths']['destination'] =
            realpath(self::$locations['folder']) .
            DIRECTORY_SEPARATOR .
            self::$locations['subfolder'] .
            self::$locations['destination'];

        self::$locations['paths']['movable'] =
            realpath(self::$locations['folder']) .
            DIRECTORY_SEPARATOR .
            self::$locations['subfolder'] .
            self::$locations['movable'];

        self::$locations['paths']['movable_testing'] =
            realpath(self::$locations['folder']) .
            DIRECTORY_SEPARATOR .
            self::$locations['subfolder'] .
            self::$locations['movable_testing'];

        $paths = array(
            self::$locations['paths']['destination'],
            self::$locations['paths']['movable'],
            self::$locations['paths']['movable_testing'],
        );

        foreach ($paths as $path)
        {
            if ( ! file_exists($path))
            {
                mkdir($path);
            }
        }

        $listing = directory_lister::listing(array(
            'directory' => self::$locations['paths']['source'],
            'method'    => 'files',
        ));

        foreach ($listing['listing'] as $source)
        {
            copy(
                $source['path'],
                self::$locations['paths']['movable'] . $source['file']
            );

            copy(
                $source['path'],
                self::$locations['paths']['movable_testing'] . $source['file']
            );
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Sorter test setup method
    */
    protected function setUp()
    {
        $this->params['folders']['source'] =
            realpath('outsource/sorter/source/') . DIRECTORY_SEPARATOR;

        $this->params['folders']['destination'] =
            realpath('outsource/sorter/destination/') . DIRECTORY_SEPARATOR;

        $this->params['folders']['movable'] =
            realpath('outsource/sorter/movable/') . DIRECTORY_SEPARATOR;

        $this->params['folders']['movable_testing'] =
            realpath('outsource/sorter/movable_testing/') . DIRECTORY_SEPARATOR;
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Sorter precondition method
    */
    protected function assertPreConditions()
    {
        $this->assertDirectoryExists($this->params['folders']['source']);
        $this->assertDirectoryExists($this->params['folders']['destination']);
        $this->assertDirectoryIsReadable($this->params['folders']['source']);
        $this->assertDirectoryIsWritable($this->params['folders']['destination']);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Test deploy method for existent parameters
    */
    public function test_deploy_method_for_existent_parameters()
    {
        $numbers = array(
            10,
            100,
            1000,
            10000,
        );

        foreach ($numbers as $number)
        {
            $sorter = new sorter(array(
                'where_to_read_files'         => $this->params['folders']['source'],
                'where_to_create_directories' => $this->params['folders']['destination'],
                'number_of_directories'       => $number,
                'folder_sufix'                => '000',
                'operation'                   => 'c',
                'overwrite'                   => TRUE,
                'types'                       => array('jpg'),
            ));

            $deploy = $sorter->deploy();

            $this->assertInternalType('bool', $deploy);
            $this->assertTrue($deploy);

            $report = $sorter->report();

            $this->assertNotEmpty($report);
            $this->assertInternalType('array', $report);
            $this->assertArrayHasKey('bool', $report);
            $this->assertInternalType('array', $report['bool']);
            $this->assertTrue($report['bool']['no_errors']);
            $this->assertTrue($report['bool']['successful_sorting']);
            $this->assertTrue($report['bool']['something_to_sort']);
            $this->assertArrayHasKey('string', $report);
            $this->assertArrayHasKey('array', $report);
            $this->assertInternalType('string', $report['string']);
            $this->assertNotEmpty($report['string']);
            $this->assertArrayHasKey('usage', $report['array']);
            $this->assertArrayHasKey('result', $report['array']);

            $errors = $sorter->get_error();

            $this->assertEmpty($errors);
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing deploy method - copy opteration - testing is on
    */
    public function test_deploy_method_copy_operation_testing_option()
    {
        $sorter = new sorter(array(
            'where_to_read_files'         => $this->params['folders']['source'],
            'where_to_create_directories' => $this->params['folders']['destination'],
            'number_of_directories'       => 10,
            'folder_sufix'                => 'xxx',
            'operation'                   => 'c',
            'overwrite'                   => TRUE,
            'types'                       => array('jpg'),
        ));

        $sorter->turn_on();

        $deploy = $sorter->deploy();

        $this->assertInternalType('bool', $deploy);
        $this->assertFalse($deploy);

        $report = $sorter->report();

        $this->assertNotEmpty($report);
        $this->assertInternalType('array', $report);
        $this->assertArrayHasKey('bool', $report);
        $this->assertInternalType('array', $report['bool']);
        $this->assertTrue($report['bool']['no_errors']);
        $this->assertFalse($report['bool']['successful_sorting']);
        $this->assertFalse($report['bool']['something_to_sort']);
        $this->assertArrayHasKey('string', $report);
        $this->assertArrayHasKey('array', $report);
        $this->assertInternalType('string', $report['string']);
        $this->assertNotEmpty($report['string']);
        $this->assertArrayHasKey('usage', $report['array']);
        $this->assertArrayHasKey('result', $report['array']);

        $errors = $sorter->get_error();

        $this->assertEmpty($errors);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing deploy method - move opteration - testing is on
    */
    public function test_deploy_method_move_operation_testing_option()
    {
        $sorter = new sorter(array(
            'where_to_read_files'         => $this->params['folders']['movable_testing'],
            'where_to_create_directories' => $this->params['folders']['destination'],
            'number_of_directories'       => 10,
            'folder_sufix'                => 'xxx',
            'operation'                   => 'm',
            'overwrite'                   => TRUE,
            'types'                       => array('jpg'),
        ));

        $sorter->turn_on();

        $deploy = $sorter->deploy();

        $this->assertInternalType('bool', $deploy);
        $this->assertFalse($deploy);

        $report = $sorter->report();

        $this->assertNotEmpty($report);
        $this->assertInternalType('array', $report);
        $this->assertArrayHasKey('bool', $report);
        $this->assertInternalType('array', $report['bool']);
        $this->assertTrue($report['bool']['no_errors']);
        $this->assertFalse($report['bool']['successful_sorting']);
        $this->assertFalse($report['bool']['something_to_sort']);
        $this->assertArrayHasKey('string', $report);
        $this->assertArrayHasKey('array', $report);
        $this->assertInternalType('string', $report['string']);
        $this->assertNotEmpty($report['string']);
        $this->assertArrayHasKey('usage', $report['array']);
        $this->assertArrayHasKey('result', $report['array']);

        $errors = $sorter->get_error();

        $this->assertEmpty($errors);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing deploy method for movable option
    */
    public function test_deploy_method_for_movable_option()
    {
        $sorter = new sorter(array(
            'where_to_read_files'         => $this->params['folders']['movable'],
            'where_to_create_directories' => $this->params['folders']['destination'],
            'number_of_directories'       => 10,
            'folder_sufix'                => '999',
            'operation'                   => 'm',
            'types'                       => array('jpg'),
        ));

        $deploy = $sorter->deploy();

        $this->assertInternalType('bool', $deploy);
        $this->assertTrue($deploy);

        $report = $sorter->report();

        $this->assertNotEmpty($report);
        $this->assertInternalType('array', $report);
        $this->assertArrayHasKey('bool', $report);
        $this->assertInternalType('array', $report['bool']);
        $this->assertTrue($report['bool']['no_errors']);
        $this->assertTrue($report['bool']['successful_sorting']);
        $this->assertTrue($report['bool']['something_to_sort']);
        $this->assertArrayHasKey('string', $report);
        $this->assertArrayHasKey('array', $report);
        $this->assertInternalType('string', $report['string']);
        $this->assertNotEmpty($report['string']);
        $this->assertArrayHasKey('usage', $report['array']);
        $this->assertArrayHasKey('result', $report['array']);

        $errors = $sorter->get_error();

        $this->assertEmpty($errors);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Test deploy method for empty parameters
    */
    public function test_deploy_method_for_empty_parameters()
    {
        $sorter = new sorter(array());

        $deploy = $sorter->deploy();

        $this->assertInternalType('bool', $deploy);
        $this->assertFalse($deploy);

        $report = $sorter->report();

        $this->assertNotEmpty($report);
        $this->assertInternalType('array', $report);
        $this->assertArrayHasKey('bool', $report);
        $this->assertInternalType('array', $report['bool']);
        $this->assertFalse($report['bool']['no_errors']);
        $this->assertFalse($report['bool']['successful_sorting']);
        $this->assertFalse($report['bool']['something_to_sort']);
        $this->assertArrayHasKey('string', $report);
        $this->assertArrayHasKey('array', $report);
        $this->assertInternalType('string', $report['string']);
        $this->assertNotEmpty($report['string']);
        $this->assertArrayHasKey('usage', $report['array']);
        $this->assertArrayHasKey('result', $report['array']);

        $errors = $sorter->get_error();

        $this->assertNotEmpty($errors);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Test deploy method only without setting number_of_directories parameter
    */
    public function test_deploy_method_without_number_of_directories()
    {
        $sorter = new sorter(array(
            'where_to_read_files'         => $this->params['folders']['movable'],
            'where_to_create_directories' => $this->params['folders']['destination'],
            'folder_sufix'                => '000',
            'operation'                   => 'c',
            'types'                       => array('jpg'),
            'settings'                    => array(
                'max_execution_time' => 60,
            ),
        ));

        $deploy = $sorter->deploy();

        $this->assertInternalType('bool', $deploy);
        $this->assertFalse($deploy);

        $report = $sorter->report();

        $this->assertNotEmpty($report);
        $this->assertInternalType('array', $report);
        $this->assertArrayHasKey('bool', $report);
        $this->assertInternalType('array', $report['bool']);
        $this->assertFalse($report['bool']['no_errors']);
        $this->assertFalse($report['bool']['successful_sorting']);
        $this->assertFalse($report['bool']['something_to_sort']);
        $this->assertArrayHasKey('string', $report);
        $this->assertArrayHasKey('array', $report);
        $this->assertInternalType('string', $report['string']);
        $this->assertNotEmpty($report['string']);
        $this->assertArrayHasKey('usage', $report['array']);
        $this->assertArrayHasKey('result', $report['array']);

        $errors = $sorter->get_error();

        $this->assertNotEmpty($errors);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Sorter test tear down after Sorter
    */
    public static function tearDownAfterClass()
    {
        self::delete_destination_folder_and_files();
        self::delete_movable_folder_and_files();

        rmdir(self::$locations['paths']['movable_testing']);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Delete destination folder and files
    *
    * @var void
    */
    private static function delete_destination_folder_and_files()
    {
        $listing = directory_lister::listing(array(
            'directory' => self::$locations['paths']['destination'],
            'method'    => 'crawl',
        ));

        foreach ($listing['listing'] as $item)
        {
            unlink($item['path']);
        }

        $listing = directory_lister::listing(array(
            'directory' => self::$locations['paths']['destination'],
            'method'    => 'folders',
        ));

        foreach ($listing['listing']['path'] as $item)
        {
            rmdir($item);
        }

        rmdir(self::$locations['paths']['destination']);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Delete movable folder and files
    *
    * @var void
    */
    private static function delete_movable_folder_and_files()
    {
        $listing = directory_lister::listing(array(
            'directory' => self::$locations['paths']['movable'],
            'method'    => 'files',
        ));

        if ($listing['count'] > 0)
        {
            foreach ($listing['listing'] as $item)
            {
                unlink($item['path']);
            }
        }

        rmdir(self::$locations['paths']['movable']);
    }

    /* ---------------------------------------------------------------------- */
}
