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
require_once('classes/directory-lister.php');
$params = array(
    'directory'  => 'D:/Browser/images/',
    'method'     => 'files',
    'print'      => TRUE,
    'display'    => FALSE,
    'delimiter'  => '',
    'date_start' => '2016-05-20',
    'date_end'   => '2016-07-20',
);
Directory_Lister::listing($params);