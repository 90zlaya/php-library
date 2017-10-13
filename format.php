<?php
/*
| -------------------------------------------------------------------
| FORMAT
| -------------------------------------------------------------------
|
| Developing and testing Format & Date_Time_Format classes
|
| -------------------------------------------------------------------
*/
require_once('classes/format.php');
require_once('classes/date-time-format.php');

echo Date_Time_Format::first_day_of_year('D', 2018);
