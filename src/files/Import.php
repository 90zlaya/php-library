<?php
/**
* Import
*
* Import data from file using customisation of PHPOffice/PhpSpreadsheet
* Location: https://github.com/PHPOffice/PhpSpreadsheet
*
* @package      PHP_Library
* @subpackage   League
* @category     Files
* @author       Ivan Skokić <iskokic@gmail.com>
*/
namespace PHP_Library\League\Files;

use PhpOffice\PhpSpreadsheet\IOFactory as IOFactory;

/**
* Import data from file using customisation of PHPOffice/PhpSpreadsheet
*/
class Import {

    // -------------------------------------------------------------------------

    /**
    * Available types
    *
    * @var array
    */
    protected static $allowed_types = array(
        'xlsx',
        'xls',
        'csv',
    );

    // -------------------------------------------------------------------------

    /**
    * Allowed types file for import
    *
    * @return array
    */
    public static function allowed_types()
    {
        return self::$allowed_types;
    }

    // -------------------------------------------------------------------------

    /**
    * Import data from file
    *
    * @param string $file_path
    *
    * @return mixed
    */
    public static function import_data($file_path)
    {
        if (file_exists($file_path))
        {
            $file_extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));

            if (in_array($file_extension, self::$allowed_types))
            {
                $spreadsheet = IOFactory::load($file_path);
                $sheetData   = $spreadsheet->getActiveSheet()->toArray(NULL, TRUE, TRUE, TRUE);

                return $sheetData;
            }
        }

        return FALSE;
    }

    // -------------------------------------------------------------------------
}
