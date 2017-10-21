<?php
/*
| -------------------------------------------------------------------
| DIRECTORY LISTER
| -------------------------------------------------------------------
|
| Developing and testing Directory_Lister class
|
| -------------------------------------------------------------------
*/
include_once '../autoload.php';

$params = array(
    'directory'  => 'D:/Zlatan/Browser/phpmailer/',
    'method'     => 'crawl',
    'print'      => 0,
    'display'    => 0,
    'reverse'    => 0,
    'delimiter'  => '',
    'date_start' => '',
    'date_end'   => '',
    'year'       => '',
    'types'      => array(),
);
Directory_Lister::listing($params);
