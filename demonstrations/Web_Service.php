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
use phplibrary\Web_Service as web_service;
use phplibrary\Format as format;

$check_file = web_service::check_file('http://php.net/images/logos/elephpant-running-78x48.gif');
format::pre($check_file);
