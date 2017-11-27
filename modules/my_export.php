<?php
/*
| -------------------------------------------------------------------
| MY_Export
| -------------------------------------------------------------------
|
| Export files
| 
| This class requires PHP Excel and PHP Library
|
| -------------------------------------------------------------------
*/
class MY_Export {
    protected static $file_name             = 'file_export';
    protected static $document_properties   = array(
        'creator'       => 'Maarten Balliauw',
        'title'         => 'Office 2007 XLSX Test Document',
        'description'   => 'Test document for Office 2007 XLSX, generated using PHP classes.',
        'keywords'      => 'office 2007 openxml php',
        'category'      => 'Test result file',
    );
    protected static $cells                 = array('', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
    
    // -------------------------------------------------------------------------
    
    /**
    * Export file
    * 
    * @param Array $params
    * 
    * @return void
    */
    public static function export($params)
    {
        $head           = isset($params['head']) ? $params['head'] : array();
        $data           = isset($params['data']) ? $params['data'] : array();
        $type           = isset($params['type']) ? $params['type'] : FALSE;
        $file_name      = isset($params['file_name']) ? $params['file_name'] : self::$file_name;
        $creator        = isset($params['document_properties']['creator']) ? $params['document_properties']['creator'] : self::$document_properties['creator'];
        $title          = isset($params['document_properties']['title']) ? $params['document_properties']['title'] : self::$document_properties['title'];
        $description    = isset($params['document_properties']['description']) ? $params['document_properties']['description'] : self::$document_properties['description'];
        $keywords       = isset($params['document_properties']['keywords']) ? $params['document_properties']['keywords'] : self::$document_properties['keywords'];
        $category       = isset($params['document_properties']['category']) ? $params['document_properties']['category'] : self::$document_properties['category'];
        
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

        // Set document properties
        $objPHPExcel->getProperties()->setCreator($creator)
                                     ->setLastModifiedBy($creator)
                                     ->setTitle($title)
                                     ->setSubject($title)
                                     ->setDescription($description)
                                     ->setKeywords($keywords)
                                     ->setCategory($category);
        
        // Print head
        foreach ($head as $item)
        {
             $objPHPExcel->setActiveSheetIndex(0)->setCellValue(self::$cells[phplibrary\Math::iterate()] . '1', $item);
        }
        
        // Number of cells
        $number_of_cells = sizeof($head);
        
        // Reset counter
        phplibrary\Math::iterate(TRUE);
        
        // Print data
        foreach ($data as $item)
        {
            $iteration      = phplibrary\Math::iterate();
            $item_indexed   = array_values($item);
            
            for ($i=1; $i<=$number_of_cells; $i++)
            {
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue(self::$cells[$i] . $iteration, $item_indexed[$i-1]);
            }
        }
        
        // If you're serving to IE over SSL, then the following may be needed
        self::for_ie_ssl();
        
        // Export type
        switch ($type)
        {
            case 'xls':
                {
                    self::to_xls($objPHPExcel, $file_name);
                } break;
            case 'xlsx':
                {
                    self::to_xlsx($objPHPExcel, $file_name);
                } break;
            default: NULL;
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Export files to Excel 2007 (xlsx)
    * 
    * @param Object $objPHPExcel
    * @param String $file_name
    * 
    * @return void
    */
    private static function to_xlsx($objPHPExcel, $file_name)
    {
        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $file_name . '.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        
        exit;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Export files to Excel 5 (xls)
    * 
    * @param Object $objPHPExcel
    * @param String $file_name
    * 
    * @return void
    */
    private static function to_xls($objPHPExcel, $file_name)
    {
        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $file_name . '.xls"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        
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
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0
    }
    
    // -------------------------------------------------------------------------
}
