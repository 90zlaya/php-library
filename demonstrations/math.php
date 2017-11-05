<?php
/*
| -------------------------------------------------------------------
| MATH
| -------------------------------------------------------------------
|
| Developing and testing MATH class
|
| -------------------------------------------------------------------
*/
include_once '../autoload.php';

$percentage = phplibrary\Math::percentage(30, 50);
phplibrary\Format::pre($percentage);
