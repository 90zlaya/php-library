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
echo 'This is index page.<br/><br/>';
/**
* PREPARING NEW METHODS
*
*/     
///////////////////////////////////////////////////////////////////////////////////////////
// SPREMA NAZIV SLIKE ZA SERVER I BAZU
    /*
    *    @param: $string
    *    @return: $spreman_naziv
    */     
    function srediNazivFajla($string){
        $extenzija = end(explode('.', $string));
        $extenzija = strtolower($extenzija);

        $low=array("Ć" => "c", "Ž" => "ž", "Š" => "š", "Č" => "c", "Ð" => "đ");
        $nazivFURL =  strtolower(strtr($string,$low));
        $nazivFURL = str_ireplace("ć","c",$nazivFURL);
        $nazivFURL = str_ireplace("ž","z",$nazivFURL);
        $nazivFURL = str_ireplace("š","s",$nazivFURL);
        $nazivFURL = str_ireplace("č","c",$nazivFURL);
        $nazivFURL = str_ireplace("đ","dj",$nazivFURL);
        $nazivFURL = trim(preg_replace('/_[a-zA-Z0-9]+(\.)/', '.', $nazivFURL, 1));
        $nazivFURL = str_ireplace(" ","_",$nazivFURL);
        $nazivFURL = str_ireplace("__","_",$nazivFURL);
        $nazivFURL = str_ireplace("___","_",$nazivFURL);
        $nazivFURL = str_ireplace("(","",$nazivFURL);
        $nazivFURL = str_ireplace(")","",$nazivFURL);
        $nazivFURL = str_ireplace('"',"",$nazivFURL);
        $nazivFURL = str_ireplace("'","",$nazivFURL);
        $nazivFURL = str_ireplace(" ","_",$nazivFURL);
        $nazivFURL = str_ireplace("(","",$nazivFURL);
        $nazivFURL = str_ireplace(")","",$nazivFURL);
        $nazivFURL = str_ireplace("%","",$nazivFURL);
        $nazivFURL = strtolower($nazivFURL);
    
        $naziv_bez_extenzije = (explode('.', $nazivFURL));
        $naziv_bez_extenzije = $naziv_bez_extenzije[0];
        
        $datum=date("ymd_Gis");
        $randomBroj = rand(1000,9999);
        $spreman_naziv = $naziv_bez_extenzije. "_" .$datum. "_" .$randomBroj. "." .$extenzija;

    return $spreman_naziv;
    }
///////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////
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
////////////////////////////////////////////////////////////////////////////////////////////////////////
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
////////////////////////////////////////////////////////////////////////////////////////////////////////
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
////////////////////////////////////////////////////////////////////////////////////////////

