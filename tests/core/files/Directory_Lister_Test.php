<?php
/**
* Directory_Lister
*
* Directory content retrieval
*
* @package      PHP_Library
* @subpackage   Core
* @category     Files
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase;
use PHP_Library\Core\Files\Directory_Lister;

/**
* Testing Directory_Lister class
*/
class Directory_Lister_Test extends TestCase {

    /* ---------------------------------------------------------------------- */

    /**
    * Directory for testing Directory_Lister class
    *
    * @var string
    */
    private $directory = __DIR__ .'/../../../outsource/directory_lister/';

    /* ---------------------------------------------------------------------- */

    /**
    * Minimalistic input to listing method
    */
    public function test_lister_on_minimalistic_input()
    {
        $listing = Directory_Lister::listing(array(
            'directory' => $this->directory,
            'method'    => 'crawl',
        ));

        $this->assertDirectoryExists($this->directory);
        $this->assertDirectoryIsReadable($this->directory);
        $this->assertIsArray($listing);
        $this->assertArrayHasKey('listing', $listing);
        $this->assertArrayHasKey('count', $listing);
        $this->assertArrayHasKey('max', $listing);
        $this->assertEquals($listing['count'], $listing['max']);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Included years parameter to listing method
    */
    public function test_lister_on_years_input()
    {
        $listing = Directory_Lister::listing(array(
            'directory' => $this->directory,
            'method'    => 'crawl',
            'years'     => array(
                2013,
                2016,
                2017,
            ),
        ));

        $this->assertEquals(25, $listing['count']);
        $this->assertEquals(25, $listing['max']);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Included types parameter to listing method
    */
    public function test_lister_on_types_input()
    {
        $listing = Directory_Lister::listing(array(
            'directory' => $this->directory,
            'method'    => 'crawl',
            'years'     => array(
                2013,
                2016,
                2017,
            ),
            'types'     => array(
                'png',
            ),
        ));

        $this->assertEquals(25, $listing['count']);
        $this->assertEquals(25, $listing['max']);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Included date_start parameter to listing method
    */
    public function test_lister_on_date_start_input()
    {
        $listing = Directory_Lister::listing(array(
            'directory'  => $this->directory,
            'method'     => 'crawl',
            'years'      => array(
                2013,
                2016,
                2017,
            ),
            'types'      => array(
                'png',
            ),
            'date_start' => '01-12',
        ));

        $this->assertEquals(4, $listing['count']);
        $this->assertEquals(25, $listing['max']);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Included date_end parameter to listing method
    */
    public function test_lister_on_date_end_input()
    {
        $listing = Directory_Lister::listing(array(
            'directory'  => $this->directory,
            'method'     => 'crawl',
            'years'      => array(
                2013,
                2016,
                2017,
            ),
            'types'      => array(
                'png',
            ),
            'date_start' => '01-12',
            'date_end'   => '01-14',
        ));

        $this->assertEquals(11, $listing['count']);
        $this->assertEquals(25, $listing['max']);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Included delimiter parameter to listing method
    */
    public function test_lister_on_delimiter_input()
    {
        $listing = Directory_Lister::listing(array(
            'directory'  => $this->directory,
            'method'     => 'crawl',
            'years'      => array(
                2013,
                2016,
                2017,
            ),
            'types'      => array(
                'png',
            ),
            'date_start' => '01-12',
            'date_end'   => '01-14',
            'delimiter'  => 'mysql',
        ));

        $this->assertEquals(1, $listing['count']);
        $this->assertEquals(25, $listing['max']);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Included reverse parameter to listing method
    */
    public function test_lister_on_reverse_input()
    {
        $listing = Directory_Lister::listing(array(
            'directory'  => $this->directory,
            'method'     => 'crawl',
            'years'      => array(
                2013,
                2016,
                2017,
            ),
            'types'      => array(
                'png',
            ),
            'date_start' => '01-12',
            'date_end'   => '01-14',
            'delimiter'  => 'mysql',
            'reverse'    => TRUE,
        ));

        $this->assertEquals(10, $listing['count']);
        $this->assertEquals(25, $listing['max']);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Included print parameter to listing method
    */
    public function test_lister_on_print_input()
    {
        ob_start();

        $listing = Directory_Lister::listing(array(
            'directory'  => $this->directory,
            'method'     => 'crawl',
            'years'      => array(
                2013,
                2016,
                2017,
            ),
            'types'      => array(
                'png',
            ),
            'date_start' => '01-12',
            'date_end'   => '01-14',
            'delimiter'  => 'mysql',
            'reverse'    => TRUE,
            'print'      => TRUE,
        ));

        ob_end_clean();

        $this->assertEquals(10, $listing['count']);
        $this->assertEquals(25, $listing['max']);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Only files within given folder
    */
    public function test_lister_on_files_call()
    {
        $listing = Directory_Lister::listing(array(
            'directory' => $this->directory,
            'method'    => 'files',
        ));

        $this->assertEquals(1, $listing['count']);
        $this->assertEquals(1, $listing['max']);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Only folders within given folder
    */
    public function test_lister_on_folders_call()
    {
        $listing = Directory_Lister::listing(array(
            'directory' => $this->directory,
            'method'    => 'folders',
        ));

        $this->assertEquals(3, $listing['count']);
        $this->assertEquals(3, $listing['max']);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Nonexistent method parameter passed
    */
    public function test_lister_when_nonexistent_method_parameter_passed()
    {
        $listing = Directory_Lister::listing(array(
            'directory' => $this->directory,
            'method'    => 'php-library',
        ));

        $this->assertIsBool($listing);
        $this->assertFalse($listing);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Crawling nonexistent files inside folder
    */
    public function test_lister_to_nonexistent_files_inside_folder()
    {
        $listing = Directory_Lister::listing(array(
            'directory' => $this->directory,
            'method'    => 'crawl',
            'types'     => array(
                'php',
            ),
        ));

        $this->assertFalse($listing);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Crawling nonexistent files inside folder
    */
    public function test_lister_for_folder_without_depth()
    {
        $listing = Directory_Lister::listing(array(
            'directory' => $this->directory. 'SQL/',
            'method'    => 'crawl',
        ));

        $this->assertFalse($listing);
    }

    /* ---------------------------------------------------------------------- */
}
