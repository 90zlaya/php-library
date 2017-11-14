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
include_once '../autoload.php';

$name = '90zlaya.jpeg';
$valid_extensions = array("jpeg");
$valid_types = array("image/jpeg");
echo phplibrary\Validation::extension($name, $valid_extensions, 'image/jpeg', $valid_types);
echo '<br/>';
$string = 'Ovo je test NAZIV 12  razmak 34 ima i đĐčćŠ.png';
echo phplibrary\Validation::rewrite($string);
echo '<br/>';
echo phplibrary\Validation::rewrite_special($string);
