<?php
/*
| -------------------------------------------------------------------
| DIRECTORY LISTER
| -------------------------------------------------------------------
|
| Developing and testing Directory_Lister class
|
| Please note that this script might get broken if your
| file/folder names start with some of special characters. 
| In that case go to Directory_Lister class and add them
| to the $forbidden_characters variable.
|
| To enable local file links you should use some kind of browser extensions:
| Firefox: https://addons.mozilla.org/en-US/firefox/addon/local-filesystem-links/
| Chrome: https://chrome.google.com/webstore/detail/enable-local-file-links/nikfmfgobenbhmocjaaboihbeocackld
|
| -------------------------------------------------------------------
*/
include_once '../autoload.php';

$params = array(
    'directory'  => 'D:/Zlatan/Browser/phpmailer/',
    'method'     => 'crawl',
    'print'      => 1,
    'display'    => 0,
    'reverse'    => 0,
    'delimiter'  => '',
    'date_start' => '',
    'date_end'   => '',
    'year'       => '',
    'types'      => array(),
);
$listing = phplibrary\Directory_Lister::listing($params);
