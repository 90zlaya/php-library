<?php
    $fh = fopen('log.txt','r');
    
    while ($line = fgets($fh))
    {
        echo $line . '<br>';
    }
    fclose($fh);
?>