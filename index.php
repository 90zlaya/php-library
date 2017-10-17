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

// -----------------------------------------------------------------------------

function poklapanjeHoroskopskihZnakova($polOsobe1, $znakOsobe1, $znakOsobe2){
    switch($polOsobe1){
        case "Male": // poklapanje za muskarca
            {
                switch($znakOsobe1){
                    case "Ovan": switch($znakOsobe2){ case "Ovan": case "Blizanci": case "Lav": case "Vaga": case "Strelac": case "Vodolija": case "Ribe": $rezultat = true; }break;
                    case "Bik": switch($znakOsobe2){ case "Rak": case "Devica": case "Škorpija": case "Jarac": case "Ribe": $rezultat = true; }break;
                    case "Blizanci": switch($znakOsobe2){ case "Lav": case "Vaga": case "Strelac": case "Vodolija": $rezultat = true; }break;
                    case "Rak": switch($znakOsobe2){ case "Devica": case "Škorpija": case "Jarac": case "Bik": case "Ribe": case "Ovan": $rezultat = true; }break;
                    case "Lav": switch($znakOsobe2){ case "Vaga": case "Strelac": case "Vodolija": case "Ovan": case "Blizanci": $rezultat = true; }break;
                    case "Devica": switch($znakOsobe2){ case "Škorpija": case "Jarac": case "Ribe": case "Bik": case "Rak": $rezultat = true; }break;
                    case "Vaga": switch($znakOsobe2){ case "Strelac": case "Vodolija": case "Ovan": case "Blizanci": $rezultat = true; }break;
                    case "Škorpija": switch($znakOsobe2){ case "Ovan": case "Bik": case "Ribe": case "Devica": $rezultat = true; }break;
                    case "Strelac": switch($znakOsobe2){ case "Vodolija": case "Ovan": case "Blizanci": case "Lav": case "Vaga": $rezultat = true; }break;
                    case "Jarac": switch($znakOsobe2){ case "Ribe": case "Bik": case "Rak": case "Devica": case "Škorpija": $rezultat = true; }break;
                    case "Vodolija": switch($znakOsobe2){ case "Ovan": case "Blizanci": case "Lav": case "Vaga": case "Strelac": $rezultat = true; }break;
                    case "Ribe": switch($znakOsobe2){ case "Bik": case "Rak": case "Škorpija": case "Jarac": $rezultat = true; }break;
                    default: $rezultat = false;
                }
            } break;
        case "Female": // poklapanje za zenu
            {
                switch($znakOsobe1){
                    case "Ovan": switch($znakOsobe2){ case "Rak": case "Bik": case "Vaga": $rezultat = true; }break;
                    case "Bik": switch($znakOsobe2){ case "Jarac": case "Škorpija": case "Lav": $rezultat = true; }break;
                    case "Blizanci": switch($znakOsobe2){ case "Lav": case "Vaga": case "Strelac": case "Vodolija": case "Ovan": $rezultat = true; }break;
                    case "Rak": switch($znakOsobe2){ case "Bik": case "Devica": case "Škorpija": case "Jarac": case "Ribe": $rezultat = true; }break;
                    case "Lav": switch($znakOsobe2){ case "Škorpija": case "Vaga": case "Strelac": case "Vodolija": case "Blizanci": $rezultat = true; }break;
                    case "Devica": switch($znakOsobe2){ case "Škorpija": case "Jarac": case "Bik": case "Rak": $rezultat = true; }break;
                    case "Vaga": switch($znakOsobe2){ case "Strelac": case "Vodolija": case "Ovan": case "Blizanci": $rezultat = true; }break;
                    case "Škorpija": switch($znakOsobe2){ case "Rak": case "Ovan": case "Bik": case "Ribe": case "Devica": $rezultat = true; }break;
                    case "Strelac": switch($znakOsobe2){ case "Vodolija": case "Ovan": case "Blizanci": case "Lav": case "Vaga": $rezultat = true; }break;
                    case "Jarac": switch($znakOsobe2){ case "Ribe": case "Bik": case "Rak": case "Devica": case "Škorpija": $rezultat = true; }break;
                    case "Vodolija": switch($znakOsobe2){ case "Ovan": case "Blizanci": case "Lav": case "Vaga": case "Strelac": $rezultat = true; }break;
                    case "Ribe": switch($znakOsobe2){ case "Ovan": case "Devica": case "Bik": case "Rak": case "Škorpija": case "Jarac": $rezultat = true; }break;
                    default: $rezultat = false;
                }
            } break;
        default: $rezultat = false;
    } // end switch pol osobe
return $rezultat;
}
function odrediHoroskopskiZnak($datumRodjenja, $formatDatuma="dmg", $vratiAlijasZnaka=false){

    /////////////////////////////////////////////////////
    // cisti parametre do numerickog
    $datumRodjenja=str_ireplace('"',"",$datumRodjenja);
    $datumRodjenja=str_ireplace("'","",$datumRodjenja);
    $datumRodjenja=str_ireplace("(","",$datumRodjenja);
    $datumRodjenja=str_ireplace(")","",$datumRodjenja);
    $datumRodjenja=str_ireplace("/","",$datumRodjenja);
    $datumRodjenja=str_ireplace(":","",$datumRodjenja);
    $datumRodjenja=str_ireplace(";","",$datumRodjenja);
    $datumRodjenja=str_ireplace("*","",$datumRodjenja);
    $datumRodjenja=str_ireplace("-","",$datumRodjenja);
    $datumRodjenja=str_ireplace("_","",$datumRodjenja);
    $datumRodjenja=str_ireplace(" ","",$datumRodjenja);
    // end cisti parametre do numerickog
    /////////////////////////////////////////////////////

    /////////////////////////////////////////////////////
    // proverava format datuma
    switch($formatDatuma){
        case "dmg": // dan-mesec-godina
                    $datumRodjenja_dan = substr($datumRodjenja,0,2);
                    $datumRodjenja_mesec = substr($datumRodjenja,2,2);
                    $datumRodjenja_godina = substr($datumRodjenja,4,3);
                    break;
        case "mdg": // mesec-dan-godina
                    $datumRodjenja_mesec = substr($datumRodjenja,0,2);
                    $datumRodjenja_dan = substr($datumRodjenja,2,2);
                    $datumRodjenja_godina = substr($datumRodjenja,4,3);
                    break;
    }
    // end proverava format datuma
    /////////////////////////////////////////////////////

    // proverava se ispravnost unetog datuma
    if( $datumRodjenja_dan < "1" or $datumRodjenja_dan > "31" or $datumRodjenja_mesec < "1" or $datumRodjenja_mesec > "12" ){ // neispravan datum
        $rezultat = "";
    }else{ // ispravan datum
        if($vratiAlijasZnaka){ // vraca alijas-broj znaka
            switch($datumRodjenja_mesec){ // proveri mesec
                case 1:  if($datumRodjenja_dan <= "19") $rezultat = 10;
                         if($datumRodjenja_dan >= "20") $rezultat = 11; break;
                case 2:  if($datumRodjenja_dan <= "18") $rezultat = 11;
                         if($datumRodjenja_dan >= "19") $rezultat = 12; break;
                case 3:  if($datumRodjenja_dan <= "20") $rezultat = 12;
                         if($datumRodjenja_dan >= "21") $rezultat = 1; break;
                case 4:  if($datumRodjenja_dan <= "19") $rezultat = 1;
                         if($datumRodjenja_dan >= "20") $rezultat = 2; break;
                case 5:  if($datumRodjenja_dan <= "20") $rezultat = 2;
                         if($datumRodjenja_dan >= "21") $rezultat = 3; break;
                case 6:  if($datumRodjenja_dan <= "20") $rezultat = 3;
                         if($datumRodjenja_dan >= "21") $rezultat = 4; break;
                case 7:  if($datumRodjenja_dan <= "22") $rezultat = 4;
                         if($datumRodjenja_dan >= "23") $rezultat = 5; break;
                case 8:  if($datumRodjenja_dan <= "22") $rezultat = 5;
                         if($datumRodjenja_dan >= "23") $rezultat = 6; break;
                case 9:  if($datumRodjenja_dan <= "22") $rezultat = 6;
                         if($datumRodjenja_dan >= "23") $rezultat = 7; break;
                case 10: if($datumRodjenja_dan <= "22") $rezultat = 7;
                         if($datumRodjenja_dan >= "23") $rezultat = 8; break;
                case 11: if($datumRodjenja_dan <= "21") $rezultat = 8;
                         if($datumRodjenja_dan >= "22") $rezultat = 9; break;
                case 12: if($datumRodjenja_dan <= "21") $rezultat = 9;
                         if($datumRodjenja_dan >= "22") $rezultat = 10; break;
            } // end switch
        }else{ // vraca ime znaka
            switch($datumRodjenja_mesec){ // proveri mesec
                case 1:  if($datumRodjenja_dan <= "19") $rezultat = "Jarac";
                         if($datumRodjenja_dan >= "20") $rezultat = "Vodilija"; break;
                case 2:  if($datumRodjenja_dan <= "18") $rezultat = "Vodilija";
                         if($datumRodjenja_dan >= "19") $rezultat = "Ribe"; break;
                case 3:  if($datumRodjenja_dan <= "20") $rezultat = "Ribe";
                         if($datumRodjenja_dan >= "21") $rezultat = "Ovan"; break;
                case 4:  if($datumRodjenja_dan <= "19") $rezultat = "Ovan";
                         if($datumRodjenja_dan >= "20") $rezultat = "Bik"; break;
                case 5:  if($datumRodjenja_dan <= "20") $rezultat = "Bik";
                         if($datumRodjenja_dan >= "21") $rezultat = "Blizanci"; break;
                case 6:  if($datumRodjenja_dan <= "20") $rezultat = "Blizanci";
                         if($datumRodjenja_dan >= "21") $rezultat = "Rak"; break;
                case 7:  if($datumRodjenja_dan <= "22") $rezultat = "Rak";
                         if($datumRodjenja_dan >= "23") $rezultat = "Lav"; break;
                case 8:  if($datumRodjenja_dan <= "22") $rezultat = "Lav";
                         if($datumRodjenja_dan >= "23") $rezultat = "Devica"; break;
                case 9:  if($datumRodjenja_dan <= "22") $rezultat = "Devica";
                         if($datumRodjenja_dan >= "23") $rezultat = "Vaga"; break;
                case 10: if($datumRodjenja_dan <= "22") $rezultat = "Vaga";
                         if($datumRodjenja_dan >= "23") $rezultat = "Škorpija"; break;
                case 11: if($datumRodjenja_dan <= "21") $rezultat = "Škorpija";
                         if($datumRodjenja_dan >= "22") $rezultat = "Strelac"; break;
                case 12: if($datumRodjenja_dan <= "21") $rezultat = "Strelac";
                         if($datumRodjenja_dan >= "22") $rezultat = "Jarac"; break;
            } // end switch
        } // end if provera alijasa znaka
    } // end if ispravan datum

    // ako se desio neki propust u switch-u ili if-u
    if($rezultat=="") $rezultat = "Neispravan datum";

return $rezultat;
}
  
// -----------------------------------------------------------------------------
