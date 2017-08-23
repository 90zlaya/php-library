<?php
/**
* Pagination class
* 
* This is special class constructed from one of special templates
* accustomed to work everywhere. It's not by standard but it might help.
*/
class Pagination{
    public static $steps = 9;

    // -------------------------------------------------------------------------
    
    /**
    * Pagination style
    * 
    * @return String $style
    */
    public static function style()
    {
        $style =  '
            <style>
                .pagination a,  .pagination span.gap {
                    float: left;
                    padding: 0 12px;
                    line-height: 28px;
                    text-decoration: none;
                    background-color: white;
                    border: 1px solid #DDD;
                    border-left-width: 0;
                    color:#333;
                }

                .pagination span.current {
                    float: left;
                    padding: 0 12px;
                    line-height: 28px;
                    text-decoration: none;
                    background-color: #009EE0;
                    border: 1px solid #009EE0;
                    border-left-width: 0;
                    color: #FFF;
                }

                .pagination {
                    border-left: 1px solid #ddd;
                    padding:0;
                    margin:0 0 20px 0;
                }
                .first{
                    padding : 0;
                    float: none;
                    border: none;
                }
                .prev {
                    padding : 0;
                    float: none;
                    border: none;
                }
                .page{
                    padding : 0;
                    float: none;
                    border: none;
                }
                .activ{
                    padding : 0;
                    float: none;
                    border: none;
                    background-color: #000;
                }
                .next{
                    padding : 0;
                    float: none;
                    border: none;
                }
                .last{
                    padding : 0;
                    float: none;
                    border: none;
                }  
            </style>          
        ';
        
        return $style;
    }

    // -------------------------------------------------------------------------
    
    /**
    * Showing pagination navigation buttons
    * 
    * Using echo command, navigation buttons are displayed on the screen
    * 
    * @param int $brstavuku
    * @param int $limitstart
    * @param String $dodParametar
    * 
    * @return void
    */
    public static function show($brstavuku, $limitstart, $dodParametar='')
    {
        echo self::style();
        $steps = self::$steps;
        
        if ($brstavuku>$steps) { // ako treba da se stmpa navigacija
             echo "<nav class='pagination' id='paginationButtons' style='margin-top:15px;'>";
             ///////////////////////////////////////////////////////////////////////
             // formatiranje po stranicama
             $nazivStranice = basename($_SERVER['PHP_SELF']);       
             $meni=ceil($brstavuku/$steps);
             $limit=0;
             $s=1;
             if ($limitstart>0){
                $limitnaz=$limitstart-$steps;
                echo "<span class='page'><a href='".$nazivStranice."?limit=0".$dodParametar."'>‹‹</a></span>";
                echo "<span class='page'><a href='".$nazivStranice."?limit=$limitnaz".$dodParametar."'>‹</a></span>";
             }
             while($s<=$meni){
                    $brStrVidljivo=2;//ovo je polovina stranica tj levo i desno 
                    if ($meni>1000) $brStrVidljivo=4;//ovo je polovina stranica tj levo i desno 
                    if ($meni>10000) $brStrVidljivo=2;//ovo je polovina stranica tj levo i desno 

                    $lmtMAX=$limitstart+($steps*$brStrVidljivo);
                    $lmtMIN=$limitstart-($steps*$brStrVidljivo);
                    
                    //podesava da prikazije 
                    if ($lmtMIN<0) {
                        $dodPar=abs($lmtMIN);
                        $lmtMAX=$lmtMAX+$dodPar;
                    }
                    
                    if ($lmtMAX>($meni*$steps)-$steps) {
                        $dodPar=$lmtMAX-( ($meni*$steps)-$steps );
                        $lmtMIN=$lmtMIN-$dodPar;
                    }

                    if ( ($limit<=$lmtMAX and $limit>=$limitstart) or ($limit>=$lmtMIN and $limit<=$limitstart) ) {
                        if ($limitstart==$limit){
                           //slucaj ako ima samo jednu stranicu 
                           if ($meni>1) {
                              echo "<span class='page current'>$s</span>";
                           }
                        } else { 
                           echo "<span class='page'><a href='".$nazivStranice."?limit=$limit".$dodParametar."'>$s</a></span>";
                        }
                    }

                    $s=$s+1;
                    $limit=$limit+$steps;
             }
             $limitstop=$limitstart+$steps;
             if ($limitstop<$brstavuku){
                //ako ima samo jednu stranicu
                if ($meni>1) {
                       echo "<span class='page'><a href='".$nazivStranice."?limit=$limitstop".$dodParametar."'>›</a></span>";
                       //poslenja stranica
                       $lmtPOSLEDNJA=($meni*$steps)-$steps;
                       $brStrPOSLEDNJA=$meni;
                       echo "<span class='page'><a href='".$nazivStranice."?limit=$lmtPOSLEDNJA".$dodParametar."'>››</a></span>";
                }
             }
             echo "</nav>";
        }             
    }
    
    // -------------------------------------------------------------------------
}
?>