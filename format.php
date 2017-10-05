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

$data = array(
    'test_one' => 'one',
    'test_two' => array(
        'three' => 3,
        'four'  => 4,
    ),
);

Format::pre($data);