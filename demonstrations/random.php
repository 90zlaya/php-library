<?php
/*
| -------------------------------------------------------------------
| RANDOM
| -------------------------------------------------------------------
|
| Developing and testing Random class
|
| -------------------------------------------------------------------
*/
include_once '../autoload.php';

use phplibrary\Random as random;
use phplibrary\Format as format;

$list = array(
     array(
        'content'     => "Monday: There's no place like home!",
        'description' => "Tweet", 
        'url'         => "https://mobile.twitter.com/elonmusk/status/730592699011604481", 
        'attributes'  => "_blank",
     ),
     array(
        'content'     => "Tuesday: There's no place like home!",
        'description' => "Tweet", 
        'url'         => "https://mobile.twitter.com/elonmusk/status/730592699011604481", 
        'attributes'  => "_blank",
     ),
     array(
        'content'     => "Wednesday: There's no place like home!",
        'description' => "Tweet", 
        'url'         => "https://mobile.twitter.com/elonmusk/status/730592699011604481", 
        'attributes'  => "_blank",
     ),
     array(
        'content'     => "Thursday: There's no place like home!",
        'description' => "Tweet", 
        'url'         => "https://mobile.twitter.com/elonmusk/status/730592699011604481", 
        'attributes'  => "_blank",
     ),
     array(
        'content'     => "Friday: There's no place like home!",
        'description' => "Tweet", 
        'url'         => "https://mobile.twitter.com/elonmusk/status/730592699011604481", 
        'attributes'  => "_blank",
     ),
     array(
        'content'     => "Saturday: There's no place like home!",
        'description' => "Tweet", 
        'url'         => "https://mobile.twitter.com/elonmusk/status/730592699011604481", 
        'attributes'  => "_blank",
     ),
     array(
        'content'     => "Sunday: There's no place like home!",
        'description' => "Tweet", 
        'url'         => "https://mobile.twitter.com/elonmusk/status/730592699011604481", 
        'attributes'  => "_blank",
     ),
);

format::pre(random::element($list, 'DAY'));
