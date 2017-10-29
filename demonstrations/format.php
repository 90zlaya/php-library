<?php
/*
| -------------------------------------------------------------------
| FORMAT
| -------------------------------------------------------------------
|
| Developing and testing Format class
|
| -------------------------------------------------------------------
*/
include_once '../autoload.php';

$bytes    = 2048;
$to_round = TRUE;

$megabytes = phplibrary\Format::bytes_to_megabytes($bytes, $to_round);
phplibrary\Format::pre($megabytes);
