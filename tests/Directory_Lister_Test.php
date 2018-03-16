<?php
/**
* Directory_Lister
*
* Directory content retrieval
*
* @package      PHP Library
* @subpackage   phplibrary
* @category     Files
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase as Test_Case;
use phplibrary\Directory_Lister as directory_lister;

/**
* Testing Directory_Lister class
*/
class Directory_Lister_Test extends Test_Case {
    
    // -------------------------------------------------------------------------
    
    /**
    * Directory for testing Directory_Lister class
    * 
    * @var String
    */
    private $directory = 'outsource/directory_lister/';
    
    // -------------------------------------------------------------------------
    
    /**
    * Minimalistic input to listing method
    */
    public function test_lister_on_minimalistic_input()
    {
        $listing = directory_lister::listing(array(
            'directory'  => realpath($this->directory) . DIRECTORY_SEPARATOR,
            'method'     => 'crawl',
        ));
        
        $this->assertDirectoryExists($this->directory);
        $this->assertDirectoryIsReadable($this->directory);
        $this->assertInternalType('array', $listing);
        $this->assertArrayHasKey('listing', $listing);
        $this->assertArrayHasKey('count', $listing);
        $this->assertArrayHasKey('max', $listing);
        $this->assertEquals($listing['count'], $listing['max']);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Included years parameter to listing method
    */
    public function test_lister_on_years_input()
    {
        $listing = directory_lister::listing(array(
            'directory'  => realpath($this->directory) . DIRECTORY_SEPARATOR,
            'method'     => 'crawl',
            'years'      => array(
                2013,
                2016,
                2017,
            ),
        ));
        
        $this->assertEquals(25, $listing['count']);
        $this->assertEquals(25, $listing['max']);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Included types parameter to listing method
    */
    public function test_lister_on_types_input()
    {
        $listing = directory_lister::listing(array(
            'directory'  => realpath($this->directory) . DIRECTORY_SEPARATOR,
            'method'     => 'crawl',
            'years'      => array(
                2013,
                2016,
                2017,
            ),
            'types'      => array(
                'png',
            ),
        ));
        
        $this->assertEquals(25, $listing['count']);
        $this->assertEquals(25, $listing['max']);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Included date_start parameter to listing method
    */
    public function test_lister_on_date_start_input()
    {
        $listing = directory_lister::listing(array(
            'directory'  => realpath($this->directory) . DIRECTORY_SEPARATOR,
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
    
    // -------------------------------------------------------------------------
    
    /**
    * Included date_end parameter to listing method
    */
    public function test_lister_on_date_end_input()
    {
        $listing = directory_lister::listing(array(
            'directory'  => realpath($this->directory) . DIRECTORY_SEPARATOR,
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
    
    // -------------------------------------------------------------------------
    
    /**
    * Included delimiter parameter to listing method
    */
    public function test_lister_on_delimiter_input()
    {
        $listing = directory_lister::listing(array(
            'directory'  => realpath($this->directory) . DIRECTORY_SEPARATOR,
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
    
    // -------------------------------------------------------------------------
    
    /**
    * Included reverse parameter to listing method
    */
    public function test_lister_on_reverse_input()
    {
        $listing = directory_lister::listing(array(
            'directory'  => realpath($this->directory) . DIRECTORY_SEPARATOR,
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
    
    // -------------------------------------------------------------------------
    
    /**
    * Included display parameter to listing method
    */
    public function test_lister_on_display_input()
    {
        ob_start();
        
        $listing = directory_lister::listing(array(
            'directory'  => realpath($this->directory) . DIRECTORY_SEPARATOR,
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
            'display'    => TRUE,
        ));
        
        ob_end_clean();
        
        $this->assertEquals(10, $listing['count']);
        $this->assertEquals(25, $listing['max']);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Included print parameter to listing method
    */
    public function test_lister_on_print_input()
    {
        ob_start();
        
        $listing = directory_lister::listing(array(
            'directory'  => realpath($this->directory) . DIRECTORY_SEPARATOR,
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
            'display'    => TRUE,
            'print'      => TRUE,
        ));
        
        ob_end_clean();
        
        $this->assertEquals(10, $listing['count']);
        $this->assertEquals(25, $listing['max']);
    }
    
    // -------------------------------------------------------------------------
}
