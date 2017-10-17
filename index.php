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
function dajCitat_link($doza="", $triggerMojiCitati=false){
    
        $linkListaMojihCitata = "https://mobile.twitter.com/elonmusk/status";
        $linkListaTudjihCitata = "https://en.m.wikipedia.org/wiki";
        $listaMojihCitata = array(
                                 array("Monday: There's no place like home!", "Tweet", "$linkListaMojihCitata/730592699011604481", "_blank"),
                                 array("Tuesday: There's no place like home!", "Tweet", "$linkListaMojihCitata/730592699011604481", "_blank"),
                                 array("Wednesday: There's no place like home!", "Tweet", "$linkListaMojihCitata/730592699011604481", "_blank"),
                                 array("Thursday: There's no place like home!", "Tweet", "$linkListaMojihCitata/730592699011604481", "_blank"),
                                 array("Friday: There's no place like home!", "Tweet", "$linkListaMojihCitata/730592699011604481", "_blank"),
                                 array("Saturday: There's no place like home!", "Tweet", "$linkListaMojihCitata/730592699011604481", "_blank"),
                                 array("Sunday: There's no place like home!", "Tweet", "$linkListaMojihCitata/730592699011604481", "_blank")
                                );
        $listaTudjihCitata = array(
                                 array("The best preparation for tomorrow is doing your best today.", "H. Jackson Brown, Jr.", "$linkListaTudjihCitata/H._Jackson_Brown,_Jr.", ""),
                                 array("The measure of who we are is what we do with what we have.", "Vince Lombardi", "$linkListaTudjihCitata/Vince_Lombardi", ""),
                                 array("Somewhere, something incredible is waiting to be known.", "Carl Sagan", "$linkListaTudjihCitata/Carl_Sagan", ""),
                                 array("The things that we love tell us what we are.", "Thomas Aquinas", "$linkListaTudjihCitata/Thomas_Aquinas", ""),
                                 array("The power of imagination makes us infinite.", "John Muir", "$linkListaTudjihCitata/John_Muir", ""),
                                 array("If you'll not settle for anything less than your best, you will be amazed what you can accomplish in your lives.", "Vince Lombardi", "$linkListaTudjihCitata/Vince_Lombardi", ""),
                                 array("By being yourself, you put something wonderful in the world that was not there before.", "Edwin Elliot", "$linkListaTudjihCitata/Edwin_Bailey_Elliott", "")
                                );
        $listaCitata = array_merge($listaMojihCitata,$listaTudjihCitata);
        $danNedelje = jddayofweek( cal_to_jd(CAL_GREGORIAN, date("m"),date("d"), date("Y")) , 1 );
        switch($doza){
            case "dnevno": // svakog dana po jedan citat
                if($triggerMojiCitati){    // samo moji citati
                    switch($danNedelje){
                        case "Monday":    $nizSaCitatom[] = array($listaMojihCitata[0][0],$listaMojihCitata[0][1],$listaMojihCitata[0][2],$listaMojihCitata[0][3]);break;
                        case "Tuesday":   $nizSaCitatom[] = array($listaMojihCitata[1][0],$listaMojihCitata[1][1],$listaMojihCitata[1][2],$listaMojihCitata[1][3]);break;
                        case "Wednesday": $nizSaCitatom[] = array($listaMojihCitata[2][0],$listaMojihCitata[2][1],$listaMojihCitata[2][2],$listaMojihCitata[2][3]);break;
                        case "Thursday":  $nizSaCitatom[] = array($listaMojihCitata[3][0],$listaMojihCitata[3][1],$listaMojihCitata[3][2],$listaMojihCitata[3][3]);break;
                        case "Friday":       $nizSaCitatom[] = array($listaMojihCitata[4][0],$listaMojihCitata[4][1],$listaMojihCitata[4][2],$listaMojihCitata[4][3]);break;
                        case "Saturday":  $nizSaCitatom[] = array($listaMojihCitata[5][0],$listaMojihCitata[5][1],$listaMojihCitata[5][2],$listaMojihCitata[5][3]);break;
                        case "Sunday":    $nizSaCitatom[] = array($listaMojihCitata[6][0],$listaMojihCitata[6][1],$listaMojihCitata[6][2],$listaMojihCitata[6][3]);break;
                    };
                }else{ // samo tudji citati
                    switch($danNedelje){
                        case "Monday":    $nizSaCitatom[] = array($listaTudjihCitata[0][0],$listaTudjihCitata[0][1],$listaTudjihCitata[0][2],$listaTudjihCitata[0][3]);break;
                        case "Tuesday":   $nizSaCitatom[] = array($listaTudjihCitata[1][0],$listaTudjihCitata[1][1],$listaTudjihCitata[1][2],$listaTudjihCitata[1][3]);break;
                        case "Wednesday": $nizSaCitatom[] = array($listaTudjihCitata[2][0],$listaTudjihCitata[2][1],$listaTudjihCitata[2][2],$listaTudjihCitata[2][3]);break;
                        case "Thursday":  $nizSaCitatom[] = array($listaTudjihCitata[3][0],$listaTudjihCitata[3][1],$listaTudjihCitata[3][2],$listaTudjihCitata[3][3]);break;
                        case "Friday":    $nizSaCitatom[] = array($listaTudjihCitata[4][0],$listaTudjihCitata[4][1],$listaTudjihCitata[4][2],$listaTudjihCitata[4][3]);break;
                        case "Saturday":  $nizSaCitatom[] = array($listaTudjihCitata[5][0],$listaTudjihCitata[5][1],$listaTudjihCitata[5][2],$listaTudjihCitata[5][3]);break;
                        case "Sunday":    $nizSaCitatom[] = array($listaTudjihCitata[6][0],$listaTudjihCitata[6][1],$listaTudjihCitata[6][2],$listaTudjihCitata[6][3]);break;
                    };
                }
                break;
            case "nasumice": // citat nasumice
                if($triggerMojiCitati){    // samo moji citati
                    $velicinaNiza = sizeof($listaMojihCitata)-1;
                    $naizmenicniCitat = rand(0,$velicinaNiza);
                    $nizSaCitatom[] = array($listaMojihCitata[$naizmenicniCitat][0],$listaMojihCitata[$naizmenicniCitat][1],$listaMojihCitata[$naizmenicniCitat][2],$listaMojihCitata[$naizmenicniCitat][3]);
                }else{ // samo tudji citati
                    $velicinaNiza = sizeof($listaTudjihCitata)-1;
                    $naizmenicniCitat = rand(0,$velicinaNiza);
                    $nizSaCitatom[] = array($listaTudjihCitata[$naizmenicniCitat][0],$listaTudjihCitata[$naizmenicniCitat][1],$listaTudjihCitata[$naizmenicniCitat][2],$listaTudjihCitata[$naizmenicniCitat][3]);
                }
                break;
            default: // kada nisu uneti parametri u funkciju - ispisuje sve citate nasumice
                    $velicinaNiza = sizeof($listaCitata)-1;
                    $naizmenicniCitat = rand(0,$velicinaNiza);
                    $nizSaCitatom[] = array($listaCitata[$naizmenicniCitat][0],$listaCitata[$naizmenicniCitat][1],$listaCitata[$naizmenicniCitat][2], "_blank");
        }
        
        return $nizSaCitatom;
}
  
// -----------------------------------------------------------------------------

