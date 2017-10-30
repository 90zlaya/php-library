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

$value           = 715000;
$to_round        = TRUE;
$round_precision = 2;

$bytes = phplibrary\Format::bytes($value, $to_round, $round_precision);
phplibrary\Format::pre($bytes);

$website = phplibrary\Format::website('google.com');
phplibrary\Format::pre($website);
