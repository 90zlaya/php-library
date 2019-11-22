<?php
/**
* Export
*
* Export files using customisation of PHPOffice/PhpSpreadsheet
* Location: https://github.com/PHPOffice/PhpSpreadsheet
*
* @package      PHP_Library
* @subpackage   Core
* @category     Files
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase as Test_Case;
use PHP_Library\Core\Files\Export as export;

/**
* Testing Email class
*/
class Export_Test extends Test_Case {

    /* ---------------------------------------------------------------------- */

    /**
    * Export parameters for export method
    *
    * @var array
    */
    private $export_parameters = array(
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
    );

    /* ---------------------------------------------------------------------- */

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

    /* ---------------------------------------------------------------------- */

    /**
    * Testing export_file method
    */
    public function test_export_file_method()
    {
        $this->assertNull(export::export_file($this->export_parameters));
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing export_file method - no parameters
    */
    public function test_export_file_method_no_parameters()
    {
        $this->assertNull(export::export_file(array()));
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing export_file method - file_name property given
    */
    public function test_export_file_method_file_name_property_given()
    {
        $this->assertNull(
            export::export_file(array_merge(
                $this->export_parameters,
                array(
                    'file_name' => 'genius_playboy_billionare_philantrophist',
                )
            ))
        );
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing export_file method - document_properties given
    */
    public function test_export_file_method_document_properties_given()
    {
        $this->assertNull(
            export::export_file(array_merge(
                $this->export_parameters,
                array(
                    'document_properties' => array(
                        'creator'     => 'Tony Stark',
                        'title'       => 'Iron Man',
                        'description' => 'Details regarding Iron Man suits',
                        'keywords'    => 'golden avenger, nitinol',
                        'category'    => 'Comic books',
                    ),
                )
            ))
        );
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing export_file method - all types given
    */
    public function test_export_file_method_all_types_given()
    {
        $types = array(
            array(
                'type' => 'xlsx',
            ),
            array(
                'type' => 'xls',
            ),
            array(
                'type' => 'csv',
            ),
            array(
                'type' => 'osp',
            ),
        );

        foreach ($types as $type)
        {
            $this->assertNull(
                export::export_file(array_merge(
                    $this->export_parameters,
                    $type
                ))
            );
        }
    }

    /* ---------------------------------------------------------------------- */
}
