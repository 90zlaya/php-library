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

$text = '<b>Lorem Ipsum</b> is simply <i>dummy</i> text of the printing and typesetting industry.';
$string = phplibrary\Format::string($text, 0, 50);
echo $string;
