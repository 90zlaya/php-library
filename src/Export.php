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
namespace phplibrary;

use PhpOffice\PhpSpreadsheet\Helper\Sample as Sample;
use PhpOffice\PhpSpreadsheet\IOFactory as IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet as Spreadsheet;

/**
* Export files using customisation class of PHPOffice/PhpSpreadsheet
*/
class Export {
    
    // -------------------------------------------------------------------------
    
    /**
    * File name
    * 
    * @var String
    */
    protected static $file_name = 'file_export';
    
    // -------------------------------------------------------------------------
    
    /**
    * Document properties
    * 
    * @var Array
    */
    protected static $document_properties = array(
        'creator'       => 'Maarten Balliauw',
        'title'         => 'Office 2007 XLSX Test Document',
        'description'   => 'Test document for Office 2007 XLSX, generated using PHP classes.',
        'keywords'      => 'office 2007 openxml php',
        'category'      => 'Test result file',
    );
    
    // -------------------------------------------------------------------------
    
    /**
    * Available cells
    * 
    * @var Array
    */
    protected static $cells = array(
        '',
        'A',
        'B',
        'C',
        'D',
        'E',
        'F',
        'G',
        'H',
        'I',
        'J',
        'K',
        'L',
        'M',
        'N',
        'O',
        'P',
        'Q',
        'R',
        'S',
        'T',
        'U',
        'V',
        'W',
        'X',
        'Y',
        'Z',
    );
    
    // -------------------------------------------------------------------------
    
    /**
    * Available types
    * 
    * @var Array
    */
    protected static $allowed_types = array(
        'xlsx', 
        'xls', 
        'csv', 
        'osp',
    );
    
    // -------------------------------------------------------------------------
    
    /**
    * Export file
    * 
    * @param Array $params
    * 
    * @return void
    */
    public static function export_file($params)
    {
        $head        = isset($params['head']) ? $params['head'] : array();
        $data        = isset($params['data']) ? $params['data'] : array();
        $type        = isset($params['type']) ? $params['type'] : 'xlsx';
        $file_name   = isset($params['file_name']) ? $params['file_name'] : self::$file_name;
        $creator     = isset($params['document_properties']['creator']) ? $params['document_properties']['creator'] : self::$document_properties['creator'];
        $title       = isset($params['document_properties']['title']) ? $params['document_properties']['title'] : self::$document_properties['title'];
        $description = isset($params['document_properties']['description']) ? $params['document_properties']['description'] : self::$document_properties['description'];
        $keywords    = isset($params['document_properties']['keywords']) ? $params['document_properties']['keywords'] : self::$document_properties['keywords'];
        $category    = isset($params['document_properties']['category']) ? $params['document_properties']['category'] : self::$document_properties['category'];
        
        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Set document properties
        $spreadsheet->getProperties()->setCreator($creator);
        $spreadsheet->getProperties()->setLastModifiedBy($creator);
        $spreadsheet->getProperties()->setTitle($title);
        $spreadsheet->getProperties()->setSubject($title);
        $spreadsheet->getProperties()->setDescription($description);
        $spreadsheet->getProperties()->setKeywords($keywords);
        $spreadsheet->getProperties()->setCategory($category);
        
        if ( ! headers_sent())
        {
            // Export type
            switch ($type)
            {
                case 'osp':
                {
                    self::line_arrangement($data);
                    self::for_ie_ssl();
                    self::to_osp($spreadsheet, $file_name);
                    break;
                }
                case 'csv':
                {
                    $csv = self::line_arrangement($data);
                    self::for_ie_ssl();
                    self::to_csv($csv, $file_name);
                    break;
                }
                case 'xls':
                {
                    self::cell_arrangement($spreadsheet, $head, $data);
                    self::for_ie_ssl();
                    self::to_xls($spreadsheet, $file_name);
                    break;
                }
                case 'xlsx':
                {
                    self::cell_arrangement($spreadsheet, $head, $data);
                    self::for_ie_ssl();
                    self::to_xlsx($spreadsheet, $file_name);
                    break;
                }
                default: NULL;
            }
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Export files to Text (osp)
    * 
    * @param Spreadsheet $spreadsheet
    * @param String $file_name
    * 
    * @return void
    */
    private static function to_osp($spreadsheet, $file_name)
    {
        // Redirect output to a client’s web browser (CSV)
        header('Content-Type: text/txt');
        header('Content-Disposition: attachment;filename="' . $file_name . '.osp"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        
        ob_end_flush();
        
        $writer = IOFactory::createWriter($spreadsheet, 'Csv');
        $writer->save('php://output');
        
        exit;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Export files to CSV (csv)
    * 
    * @param String $csv
    * @param String $file_name
    * 
    * @return void
    */
    private static function to_csv($csv, $file_name)
    {
        // Redirect output to a client’s web browser (CSV)
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename="' . $file_name . '.csv"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        
        ob_end_flush();
        
        print $csv;
        
        exit;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Export files to Excel 5 (xls)
    * 
    * @param Spreadsheet $spreadsheet
    * @param String $file_name
    * 
    * @return void
    */
    private static function to_xls($spreadsheet, $file_name)
    {
        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $file_name . '.xls"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        
        $writer = IOFactory::createWriter($spreadsheet, 'Xls');
        $writer->save('php://output');
        
        exit;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Export files to Excel 2007 (xlsx)
    * 
    * @param Spreadsheet $spreadsheet
    * @param String $file_name
    * 
    * @return void
    */
    private static function to_xlsx($spreadsheet, $file_name)
    {
        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $file_name . '.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        
        exit;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Serving filest for Internet Explorer over SSL
    * 
    * @return void
    */
    private static function for_ie_ssl()
    {
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Arrange data in line for export
    * 
    * @param Array $data
    * 
    * @return mixed
    */
    private static function line_arrangement($data)
    {
        if ( ! empty($data))
        {
            ob_start();
            
            foreach ($data as $item)
            {
                $item_indexed      = array_values($item);
                $item_indexed_size = count($item_indexed);
                $value             = '';
                
                for ($i=0; $i<$item_indexed_size; $i++)
                {
                    $value .= $item_indexed[$i] . ';';
                }
                
                echo $value . "\r\n";
            }
        }
        
        return FALSE;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Arrange data in cells for export
    * 
    * @param Spreadsheet $spreadsheet
    * @param Array $head
    * @param Array $data
    * 
    * @return mixed
    */
    private static function cell_arrangement($spreadsheet, $head, $data)
    {
        if ( ! empty($data))
        {
            // Print head
            $iteration = 1;
            
            foreach ($head as $item)
            {
                $spreadsheet->getActiveSheet()->getColumnDimension(self::$cells[$iteration])->setAutoSize(TRUE);
                $spreadsheet->setActiveSheetIndex(0)->setCellValue(self::$cells[$iteration] . '1', $item);
                
                $iteration++;
            }
            
            // Number of cells
            $number_of_cells = count($head);
            
            // Print data
            $iteration = 2;
            
            foreach ($data as $item)
            {
                $item_indexed = array_values($item);
                
                for ($i=1; $i<=$number_of_cells; $i++)
                {
                    $spreadsheet->setActiveSheetIndex(0)->setCellValue(self::$cells[$i] . $iteration, $item_indexed[$i-1]);
                }
                
                $iteration++;
            }
        }
        
        return FALSE;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Allowed types for export
    * 
    * @return Array
    */
    public static function allowed_types()
    {
        return self::$allowed_types;
    }
    
    // -------------------------------------------------------------------------
}
