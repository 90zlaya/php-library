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
    'directory'  => 'D:/Browser/images test/',
    'method'     => 'files',
    'print'      => TRUE,
    'display'    => FALSE,
    'delimiter'  => '',
    'date_start' => '',
    'date_end'   => '',
);
Directory_Lister::listing($params);