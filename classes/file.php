<?php
/**
* File-related operations
*/
class File{

    // -------------------------------------------------------------------------    
    
    /**
    * Writing data to file
    * 
    * @param String $file_location
    * @param String $write_data
    * 
    * @return mixed
    */
    public static function write_to_file($file_location, $write_data)
    {
        if(empty($file_location) || empty($write_data))
        {
            return FALSE;
        }
        else
        {
            $new_data = $write_data . PHP_EOL;
            
            if(@file_exists($file_location))
            {
                $file = @fopen($file_location, 'r');
                $data = @fread($file, @filesize($file_location));
                
                $data .=  $new_data;
                
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
    
    
////////////////////////////////////////////////////////////////////////////////
// CITANJE ZADNJEG PODATKA IZ FAJLA
/*
*    @param: $lokacijaCounterError // lokacija dokumenta
*
*    @return: null
*/
public static function citajZadnjiPodatakIzFajla($lokacijaCounterError)
{
    $line = '';

    $f = fopen($lokacijaCounterError, 'r');
    $cursor = -1;

    fseek($f, $cursor, SEEK_END);
    $char = fgetc($f);

    /**
     * Trim trailing newline chars of the file
     */
    while ($char === "\n" || $char === "\r") {
        fseek($f, $cursor--, SEEK_END);
        $char = fgetc($f);
    }

    /**
     * Read until the start of file or first newline char
     */
    while ($char !== false && $char !== "\n" && $char !== "\r") {
        /**
         * Prepend the new char
         */
        $line = $char . $line;
        fseek($f, $cursor--, SEEK_END);
        $char = fgetc($f);
    }
return $line;                 
}
////////////////////////////////////////////////////////////////////////////////
// UPIS U FAJL KADA SE NESTO DESI
/*
*    @param: $fileLocation // lokacija dokumenta
*    @param: $dataEntry // podaci za unos
*
*    @return: null
*/
public static function hitCounterOnOccasion($fileLocation, $dataEntry, $sifraRadnika, $sifraObjekta )
{
    if( file_exists($fileLocation) )
    {
        $fil = fopen($fileLocation, r);
        $dat = fread($fil, filesize($fileLocation));
        
        $trenutniDatum = date("d.m.Y H:i");
        $podaciZaUpis = $trenutniDatum. " / " .$sifraRadnika. " / " .$sifraObjekta. " / " .$dataEntry. " ";
        
        $dat .=  PHP_EOL .$podaciZaUpis;
        
        fclose($fil);
        $fil = fopen($fileLocation, w);
        fwrite($fil, $dat);
    }else{
        $fil = fopen($fileLocation, w);
        fwrite($fil, 1);    
        echo '1';
        fclose($fil);
    }
} 
////////////////////////////////////////////////////////////////////////////////
}
?>    