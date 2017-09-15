<?php
/*
| -------------------------------------------------------------------
| FORMAT
| -------------------------------------------------------------------
|
| Developing and testing Format & Date_Time_Format classes
|
| -------------------------------------------------------------------
*/
require_once('classes/date-time-format.php');
require_once('classes/validation.php');

$string = 'test NAZIV - a$ ČĆŠ čć ">>$#"%& 0569 fajla.JPG';

$string = Validation::rewrite($string);
echo Date_Time_Format::prefix($string);