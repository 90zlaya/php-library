<?php
/*
| -------------------------------------------------------------------
| FILE_VERSION
| -------------------------------------------------------------------
|
| Developing and testing File_Version class
|
| -------------------------------------------------------------------
*/
use phplibrary\File_Version as file_version;

file_version::dump(array(
    'file_names' => array(
        'log_files'    => 'files',
        'log_versions' => 'versions',
    ),
    'listing'    => array(
        'directory'  => 'D:/Zlatan/Browser/phpmailer/',
        'method'     => 'crawl',
    ),
));
