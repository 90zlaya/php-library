<?php
/*
| -------------------------------------------------------------------
| INDEX PAGE
| -------------------------------------------------------------------
| This file contains default view for testing classes.
|
| You may instantiate classes here, call methods and pass parameters
| to and from methods in purpose of testing and developing.
|
| -------------------------------------------------------------------
*/
echo 'This is index page.';

/**
* PREPARING NEW METHODS
*
*/
////////////////////////////////////////////////////////////////////////////////
// CITANJE ZADNJEG PODATKA IZ FAJLA
/*
*    @param: $lokacijaCounterError // lokacija dokumenta
*
*    @return: null
*/
function citajZadnjiPodatakIzFajla($lokacijaCounterError)
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
function hitCounterOnOccasion($fileLocation, $dataEntry, $sifraRadnika, $sifraObjekta )
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
// BROJANJE POSETA STRANICE
/*
*    @param: $fileLocation // lokacija dokumenta
*    @return: null
*/
function hitCounterFunction($fileLocation)
{
    if( file_exists($fileLocation) ){
        $fil = fopen($fileLocation, r);
        $dat = fread($fil, filesize($fileLocation));
        
        $trenutniDatum = date("d.m.Y H:i");
        $podaciZaUpis = $trenutniDatum. " / " .$sifraRadnika. " / " .$sifraObjekta;
        
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
