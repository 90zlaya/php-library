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
| To enable local file links you should use some kind of browser extension:
| Firefox: https://addons.mozilla.org/en-US/firefox/addon/local-filesystem-links/
| Chrome: https://chrome.google.com/webstore/detail/enable-local-file-links/nikfmfgobenbhmocjaaboihbeocackld
|
| -------------------------------------------------------------------
*/
use phplibrary\Directory_Lister as directory_lister;
use phplibrary\Format as format;

$params = array(
    'directory'  => 'D:/Zlatan/Browser/phpmailer/',
    'method'     => 'crawl',
    'print'      => FALSE,
    'display'    => FALSE,
    'reverse'    => FALSE,
    'delimiter'  => '',
    'date_start' => '',
    'date_end'   => '',
    'year'       => '',
    'types'      => array('txt'),
);

$listing = directory_lister::listing($params);
format::pre($listing, TRUE);
