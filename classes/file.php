<?php
/*
| -------------------------------------------------------------------
| FILE
| -------------------------------------------------------------------
|
| File-related operations
|
| -------------------------------------------------------------------
*/
namespace phplibrary;

class File {

    // -------------------------------------------------------------------------    
    
    /**
    * Writing data to file
    * 
    * @param String $file_location
    * @param String $write_data
    * @param Bool $last_in
    * 
    * @return mixed
    */
    public static function write_to_file($file_location, $write_data, $last_in=TRUE)
    {
        if (empty($file_location) || empty($write_data))
        {
            return FALSE;
        }
        else
        {
            $new_data = $write_data . PHP_EOL;
            
            if (@file_exists($file_location))
            {
                $file     = @fopen($file_location, 'r');
                $old_data = @fread($file, @filesize($file_location));
                
                $data = $last_in ? $old_data . $new_data : $new_data . $old_data;
                
                @fclose($file);
                $file = @fopen($file_location, 'w');
                @fwrite($file, $data);
            }
            else
            {
                $file = @fopen($file_location, 'w');
                @fwrite($file, $new_data);
            }
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Reading last data from file
    * 
    * @param String $file_location
    * 
    * @return String $line
    */
    public static function read_from_file($file_location)
    {
        $f = @fopen($file_location, 'r');
        $cursor = -1;

        @fseek($f, $cursor, SEEK_END);
        $char = @fgetc($f);
        
        while ($char === "\n" || $char === "\r")
        {
            @fseek($f, $cursor--, SEEK_END);
            $char = @fgetc($f);
        }
        
        $line = '';
        while ($char !== false && $char !== "\n" && $char !== "\r")
        {
            $line = $char . $line;
            @fseek($f, $cursor--, SEEK_END);
            $char = @fgetc($f);
        }
        
        return $line;                 
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Read file contents into an array
    * 
    * @param String $file_location
    * @param Bool $to_unlink
    * 
    * @return Array
    */
    public static function read_file_contents($file_location, $to_unlink=FALSE)
    {
        $status = FALSE;
        $items  = array();
        
        if ( ! empty($file_location))
        {
            $status = TRUE;
            
            $file_contents = file($file_location);
            
            $to_unlink ? unlink($file_location) : NULL; 
            
            foreach ($file_contents as $line)
            {
                $items[] = explode(';', $line);
            }
        }
        
        return array(
            'status' => $status,
            'items'  => $items,
        );
    }
    
    // -------------------------------------------------------------------------
}
?>