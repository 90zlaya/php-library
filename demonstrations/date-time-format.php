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
use phplibrary\Date_Time_Format as date_time_format;
use phplibrary\Format as format;

$current = date_time_format::current();

echo $current . '<br/>';

$user_date = '08.11.2017 16:07';

echo $user_date . '<br/>';

$database_date = date_time_format::format_to_database($user_date);
$user_date = date_time_format::format_to_user($database_date);

echo $database_date . '<br/>' . $user_date . '<br/>';

$user_date_format = date_time_format::format($user_date, TRUE);
$database_date_format = date_time_format::format($database_date, TRUE);

echo $database_date_format . '<br/>' . $user_date_format . '<br/>';

echo date_time_format::minutes_to_hours(61) . '<br/>';
echo date_time_format::hours_to_minutes('61:55') . '<br/>';

echo date_time_format::days_before(75);

$list_of_days = date_time_format::get_days('serbian', 3, FALSE);
format::pre($list_of_days);

$list_of_months = date_time_format::get_months('serbian', 3);
format::pre($list_of_months);

echo date_time_format::format('2017-10-23 15:57:19');
format::pre(date_time_format::number_to_month(date('n'), 'english'));
format::pre(date_time_format::number_to_day(date('N'), 'english'));
