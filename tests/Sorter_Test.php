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
    * Parameters for test
    *
    * @var array
    */
    private $params = array();

    // -------------------------------------------------------------------------

    /**
    * Locations for test setup
    *
    * @var array
    */
    protected static $locations = array(
        'folder'      => 'outsource/',
        'subfolder'   => 'sorter/',
        'destination' => 'destination/',
        'source'      => 'source/',
        'movable'     => 'movable/',
        'paths'       => array(),
    );

    // -------------------------------------------------------------------------

    /**
    * Sorter test setup before class method
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

        $paths = array(
            self::$locations['paths']['destination'],
            self::$locations['paths']['movable'],
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
        }
    }

    // -------------------------------------------------------------------------

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
    }

    // -------------------------------------------------------------------------

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

    // -------------------------------------------------------------------------

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
            $this->assertEmpty($report['array']['result']['errors']);
        }
    }

    // -------------------------------------------------------------------------

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
        $this->assertEmpty($report['array']['result']['errors']);
    }

    // -------------------------------------------------------------------------

    /**
    * Test deploy method for nonexistent parameters
    */
    public function test_deploy_method_for_nonexistent_parameters()
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
        $this->assertNotEmpty($report['array']['result']['errors']);
    }

    // -------------------------------------------------------------------------

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
        $this->assertNotEmpty($report['array']['result']['errors']);
    }

    // -------------------------------------------------------------------------

    /**
    * Sorter test tear down after class method
    */
    public static function tearDownAfterClass()
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

        foreach ($listing['listing']['path'] as $path)
        {
            rmdir($path);
        }

        rmdir(self::$locations['paths']['destination']);

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

    // -------------------------------------------------------------------------
}
