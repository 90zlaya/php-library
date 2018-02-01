<?php
/*
| -------------------------------------------------------------------
| VALIDATION
| -------------------------------------------------------------------
|
| Developing and testing Validation class
|
| -------------------------------------------------------------------
*/
use phplibrary\Validation as validation;
use phplibrary\Format as format;

$name             = '90zlaya.jpeg';
$valid_extensions = array("jpeg");
$valid_types      = array("image/jpeg");

echo validation::extension($name, $valid_extensions, 'image/jpeg', $valid_types);
echo '<br/>';

$string = 'Ovo je test NAZIV 12  razmak 34 ima i đĐčćŠ.png';

echo validation::rewrite($string);
echo '<br/>';
echo validation::rewrite_special($string);
