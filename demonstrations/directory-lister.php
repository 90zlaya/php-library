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
    'directory'  => 'D:/Browser/phpmailer/',
    'method'     => 'files',
    'print'      => FALSE,
    'display'    => FALSE,
    'reverse'    => FALSE,
    'delimiter'  => '',
    'date_start' => '',
    'date_end'   => '',
);
Directory_Lister::listing($params);

$params = array(
    'directory'  => 'D:/Browser/phpmailer/',
    'method'     => 'folders',
    'print'      => TRUE,
    'display'    => FALSE,
    'reverse'    => FALSE,
    'delimiter'  => '',
    'date_start' => '',
    'date_end'   => '',
);
Directory_Lister::listing($params);
