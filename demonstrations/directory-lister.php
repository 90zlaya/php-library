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
require_once('../classes/directory-lister.php');
$params = array(
    'directory'  => 'D:/Browser/img/',
    'method'     => 'files',
    'print'      => TRUE,
    'display'    => FALSE,
    'reverse'    => FALSE,
    'delimiter'  => '',
    'date_start' => '2016-03-10',
    'date_end'   => '',
);
Directory_Lister::listing($params);