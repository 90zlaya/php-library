<?php
/**
* Import
*
* Import data from file using customisation of PHPOffice/PhpSpreadsheet
* Location: https://github.com/PHPOffice/PhpSpreadsheet
*
* @package      PHP Library
* @subpackage   phplibrary
* @category     Files
* @author       Ivan Skokić <iskokic@gmail.com>
*/
use PHPUnit\Framework\TestCase as Test_Case;
use phplibrary\Import as import;

/**
* Testing Import class
*/
class Import_Test extends Test_Case {

    // -------------------------------------------------------------------------

    /**
    * Testing allowed_types method
    */
    public function test_allowed_types_method()
    {
        $types = import::allowed_types();

        $this->assertNotEmpty($types);
        $this->assertInternalType('array', $types);
        $this->assertCount(3, $types);

        foreach ($types as $type)
        {
            $this->assertInternalType('string', $type);
        }
    }

    // -------------------------------------------------------------------------

    /**
    * Testing import_data method
    */
    public function test_import_data_method()
    {
        $return = import::import_data(realpath('outsource/import/example1.xls'));

        $this->assertNotFalse($return);
        $this->assertInternalType('array', $return);
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

        $return = import::import_data(NULL);

        $this->assertFalse($return);

        $return = import::import_data('test/test.csv');

        $this->assertFalse($return);
    }

    // -------------------------------------------------------------------------
}
