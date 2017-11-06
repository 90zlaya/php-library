<?php
/*
| -------------------------------------------------------------------
| DATE TIME FORMAT
| -------------------------------------------------------------------
|
| Developing and testing DATE_TIME_FORMAT class
|
| -------------------------------------------------------------------
*/
include_once '../autoload.php';

$current =  phplibrary\Date_Time_Format::current();

echo phplibrary\Date_Time_Format::compare($current);
