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

$current = phplibrary\Date_Time_Format::current();

$user_date = '08.11.2017';

echo $user_date . '<br/>';

$database_date = phplibrary\Date_Time_Format::format_to_database($user_date);
$user_date = phplibrary\Date_Time_Format::format_to_user($database_date);

echo $database_date . '<br/>' . $user_date . '<br/>';

$user_date_format = phplibrary\Date_Time_Format::format($user_date, TRUE);
$database_date_format = phplibrary\Date_Time_Format::format($database_date, TRUE);

echo $database_date_format . '<br/>' . $user_date_format . '<br/>';
