<?php
/**
* Dump
*
* Dump database from SQL server
*
* @package      PHP Library
* @subpackage   phplibrary
* @category     SQL
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase as Test_Case;
use phplibrary\Dump as dump;

/**
* Testing Dump class
*/
class Dump_Test extends Test_Case {
    
    // -------------------------------------------------------------------------
    
    /**
    * Command for dump execution    
    * 
    * @var String
    */
    private static $command = 'mysqldump';
    
    // -------------------------------------------------------------------------
    
    /**
    * Destination folder for dumped files
    * 
    * @var String
    */
    private static $destination = '';
    
    // -------------------------------------------------------------------------
    
    /**
    * Dump object data
    *
    * @var Object
    */
    private $dump_object;

    // -------------------------------------------------------------------------
    
    /**
    * Dump test setup before class method
    */
    public static function setUpBeforeClass()
    {
        $command = 'C:/xampp/mysql/bin/mysqldump.exe';

        if (file_exists($command))
        {
            self::$command = $command;
        }
        
        $destination  = realpath('outsource/');
        $destination .= DIRECTORY_SEPARATOR;
        $destination .= 'dump/';

        if (file_exists($destination))
        {
            self::$destination = $destination;
        }
        else
        {
            if (mkdir($destination))
            {
                self::$destination = $destination;
            }
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Dump test setup method
    */
    public function setUp()
    {
        $this->dump_object = new dump(array(
            'command'     => self::$command,
            'destination' => self::$destination,
            'databases'   => array(
                'phpmyadmin',
            ),
        ));
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing get_messages method for all messages
    */
    public function test_get_messages_method_for_all_messages()
    {
        $result = $this->dump_object->get_messages();
        
        $this->assertInternalType('array', $result);
        
        $this->assertArrayHasKey('success', $result);
        $this->assertEmpty($result['success']);
        
        $this->assertArrayHasKey('error', $result);
        $this->assertEmpty($result['error']);
        
        $this->assertArrayHasKey('file', $result);
        $this->assertEmpty($result['file']);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing get_messages method for other messages
    */
    public function test_get_messages_method_for_other_messages()
    {
        $statuses = array(
            'SUCCESS',
            'ERROR',
            'FILE',
            '',
            NULL,
        );
        
        foreach ($statuses as $status)
        {
            $result = $this->dump_object->get_messages($status);
            
            $this->assertInternalType('array', $result);
            $this->assertEmpty($result);
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Dump test tear down after class method
    */
    public static function tearDownAfterClass()
    {
        rmdir(self::$destination);
    }
    
    // -------------------------------------------------------------------------
}
