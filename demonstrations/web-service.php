<?php
/*
| -------------------------------------------------------------------
| WEB SERVICE
| -------------------------------------------------------------------
|
| Developing and testing Web_Service class
|
| -------------------------------------------------------------------
*/
include_once '../autoload.php';

$check_file = phplibrary\Web_Service::check_file('http://php.net/images/logos/elephpant-running-78x48.gif');
phplibrary\Format::pre($check_file);
