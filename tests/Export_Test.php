<?php
/**
* Export
*
* Export files using customisation class of PHPOffice/PhpSpreadsheet
* Location: https://github.com/PHPOffice/PhpSpreadsheet
*
* @package      PHP Library
* @subpackage   phplibrary
* @category     Files
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase as Test_Case;
use phplibrary\Export as export;

/**
* Testing Email class
*/
class Export_Test extends Test_Case {
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing return value of allowed_types method
    */
    public function test_allowed_types_method()
    {
        $types = export::allowed_types();
        
        $this->assertNotEmpty($types);
        $this->assertInternalType('array', $types);
        $this->assertCount(4, $types);
        
        foreach ($types as $type)
        {
            $this->assertInternalType('string', $type);
            $this->assertNotEmpty($type);
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing export_file method
    */
    public function test_export_file_method()
    {
        $this->assertNull(
            export::export_file(array(
                'data_types' => array(
                    array(
                        'index' => 0,
                        'type'  => 'TEXT',
                    ),
                ),
                'head'       => array(
                    'Title',
                    'Number',
                ),
                'data'       => array(
                    array(
                        'title'  => 'Value11',
                        'number' => '301234',
                    ),
                    array(
                        'title'  => 'Value21',
                        'number' => '852741963001',
                    ),
                    array(
                        'title'  => 'Value31',
                        'number' => '22.56',
                    ),
                ),
                'type'       => 'xls',
            ))
        );
    }
    
    // -------------------------------------------------------------------------
}
