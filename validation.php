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
require_once('classes/validation.php');

/*
$name = '90zlaya.jpeg';
$valid_extensions = array("jpeg");
$valid_types = array("image/jpeg");
echo Validation::extension($name, $valid_extensions, 'image/jpeg', $valid_types);
*/

$string = 'Ovo je test NAZIV 12  razmak 34 ima i đĐčćŠ.png';
echo Validation::rewrite($string);
echo '<br/>';
echo Validation::rewrite_special($string);
