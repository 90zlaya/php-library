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
require_once('classes/format.php');
require_once('classes/date-time-format.php');

$string = 'Testing string length';

echo Format::correct_string_length($string);