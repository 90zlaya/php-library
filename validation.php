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

$name = '90zlaya.jpeg';
$valid_extensions = array("jpeg");
$valid_types = array("image/jpeg");
echo Validation::extension($name, $valid_extensions, 'image/jpeg', $valid_types);
