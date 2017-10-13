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
// PROVERAVA KOJI JE DAN PRVI JANUAR U GODINI
    /*
    *    @param: void
    *    @return: $g_dan_dod // brojka
    *        a) ako je ponedeljak sve ostaje isto 
    *        b) ako je neki drugi dan nedelja se smanjuje za jedan
    */
    function godina_start() {
        $godina=date("Y");
        $br_nedelje=date("W");
        
        $datum_1_jan= date('D', strtotime('01.01.'.$godina));
        //echo "$datum_1_jan<BR>";
        switch ($datum_1_jan) {
          case "Mon": $g_dan_dod="01"; break;
          case "Tue": $g_dan_dod="06"; break;
          case "Wed": $g_dan_dod="05"; break;
          case "Thu": $g_dan_dod="04"; break;
          case "Fri": $g_dan_dod="03"; break;
          case "Sat": $g_dan_dod="02"; break;
          case "Sun": $g_dan_dod="08"; break;
        }
    return $g_dan_dod;
    }
////////////////////////////////////////////////////////////////////////////////
