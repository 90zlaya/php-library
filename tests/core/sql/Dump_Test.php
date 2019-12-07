<?php
/**
* Dump
*
* Dump database from SQL server
*
* @package      PHP_Library
* @subpackage   Core
* @category     SQL
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase;
use PHP_Library\Core\SQL\Dump;

/**
* Testing Dump class
*/
class Dump_Test extends TestCase {

    /* ---------------------------------------------------------------------- */

    /**
    * Command for dump execution
    *
    * @var string
    */
    private static $command = 'mysqldump';

    /* ---------------------------------------------------------------------- */

    /**
    * Destination folder for dumped files
    *
    * @var string
    */
    private static $destination = '';

    /* ---------------------------------------------------------------------- */

    /**
    * Dumped files to be deleted
    * after test is executed
    *
    * @var array
    */
    private static $files = array();

    /* ---------------------------------------------------------------------- */

    /**
    * Dump object data
    *
    * @var object
    */
    private $dump_object;

    /* ---------------------------------------------------------------------- */

    /**
    * Dump constructor data
    *
    * @var array
    */
    private $dump_data = array();

    /* ---------------------------------------------------------------------- */

    /**
    * Dump test setup before Dump
    */
    public static function setUpBeforeClass(): void
    {
        $command = 'C:/xampp/mysql/bin/mysqldump.exe';

        if (file_exists($command))
        {
            self::$command = $command;
        }

        $destination = __DIR__ . '/../../../outsource/dump/';

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

    /* ---------------------------------------------------------------------- */

    /**
    * Dump test setup method
    */
    public function setUp(): void
    {
        $this->dump_data = array(
            'command'     => self::$command,
            'destination' => self::$destination,
            'databases'   => array(
                'phpmyadmin',
            ),
        );

        $this->dump_object = new Dump($this->dump_data);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing get_message method
    */
    public function test_get_message_method()
    {
        $result = $this->dump_object->get_message();

        $this->assertIsArray($result);

        $this->assertArrayHasKey('success', $result);
        $this->assertEmpty($result['success']);

        $this->assertArrayHasKey('error', $result);
        $this->assertEmpty($result['error']);

        $this->assertArrayHasKey('file', $result);
        $this->assertEmpty($result['file']);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing get_* methods
    */
    public function test_get_asterix_methods()
    {
        $results = array();

        $results[] = $this->dump_object->get_success();
        $results[] = $this->dump_object->get_error();
        $results[] = $this->dump_object->get_file();

        foreach ($results as $result)
        {
            $this->assertIsArray($result);
            $this->assertEmpty($result);
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing mysql_dump method
    * with default parameters
    */
    public function test_mysql_dump_method_default_params()
    {
        $result = $this->dump_object->mysql();

        $this->assertIsBool($result);
        $this->assertTrue($result);

        array_push(self::$files, $this->dump_object->get_file());
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing mysql_dump method
    * with override option enabled - testing is on
    */
    public function test_mysql_dump_method_default_params_testing_is_on()
    {
        $this->dump_object->turn_on();

        $result = $this->dump_object->mysql(TRUE);

        $this->assertIsBool($result);
        $this->assertFalse($result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing mysql_dump method
    * with override option enabled
    */
    public function test_mysql_dump_method_override_enabled()
    {
        $result = $this->dump_object->mysql(TRUE);

        $this->assertIsBool($result);
        $this->assertTrue($result);

        array_push(self::$files, $this->dump_object->get_file());
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing mysql_dump method
    * with given connection string
    */
    public function test_mysql_dump_method_given_connection_string()
    {
        $dump = new Dump(array(
            'connection' => array(
                'host'     => 'localhost',
                'username' => 'root',
                'password' => '',
            ),
        ));

        $result = $dump->mysql();

        $this->assertIsBool($result);
        $this->assertFalse($result);

        array_push(self::$files, $dump->get_file());
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing mysql_dump method
    * without database parameter
    */
    public function test_mysql_dump_method_no_database()
    {
        $dump = new Dump(array(
            'command'     => self::$command,
            'destination' => self::$destination,
        ));

        $result = $dump->mysql();

        $this->assertIsBool($result);
        $this->assertFalse($result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Dump test tear down after Dump
    */
    public static function tearDownAfterClass(): void
    {
        if ( ! empty(self::$files))
        {
            foreach (self::$files as $file)
            {
                foreach ($file as $item)
                {
                    unlink($item);
                }
            }

            $day_directory  = self::$destination;
            $day_directory .= 'mysqldump/';
            $day_directory .= date('ym');
            $day_directory .= '/';
            $day_directory .= date('d');
            $day_directory .= '/';

            $month_directory  = self::$destination;
            $month_directory .= 'mysqldump/';
            $month_directory .= date('ym');
            $month_directory .= '/';

            $mysqldump_directory  = self::$destination;
            $mysqldump_directory .= 'mysqldump/';

            rmdir($day_directory);
            rmdir($month_directory);
            rmdir($mysqldump_directory);
            rmdir(self::$destination);
        }
    }

    /* ---------------------------------------------------------------------- */
}
