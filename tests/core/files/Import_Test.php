<?php
/**
* Import
*
* Import data from file using customisation of PHPOffice/PhpSpreadsheet
* Location: https://github.com/PHPOffice/PhpSpreadsheet
*
* @package      PHP_Library
* @subpackage   Core
* @category     Files
* @author       Ivan Skokić <iskokic@gmail.com>
*/
use PHPUnit\Framework\TestCase;
use PHP_Library\Core\Files\Import;

/**
* Testing Import class
*/
class Import_Test extends TestCase {

    /* ---------------------------------------------------------------------- */

    /**
    * Testing allowed_types method
    */
    public function test_allowed_types_method()
    {
        $types = Import::allowed_types();

        $this->assertNotEmpty($types);
        $this->assertIsArray($types);
        $this->assertCount(3, $types);

        foreach ($types as $type)
        {
            $this->assertIsString($type);
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing import_data method
    */
    public function test_import_data_method()
    {
        $return = Import::import_data(realpath('outsource/import/example1.xls'));

        $this->assertNotFalse($return);
        $this->assertIsArray($return);
        $this->assertNotEmpty($return);

        $keys = array(
            'A',
            'B',
            'C',
            'D',
            'E',
            'F',
        );

        foreach ($return as $data)
        {
            foreach ($keys as $key)
            {
                $this->assertArrayHasKey($key, $data);
            }
        }

        $return = Import::import_data(NULL);

        $this->assertFalse($return);

        $return = Import::import_data('test/test.csv');

        $this->assertFalse($return);
    }

    /* ---------------------------------------------------------------------- */
}
