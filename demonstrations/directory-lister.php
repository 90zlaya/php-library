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
    'print'      => 0,
    'display'    => 0,
    'reverse'    => 0,
    'delimiter'  => '',
    'date_start' => '',
    'date_end'   => '',
);
Directory_Lister::listing($params);

$params = array(
    'directory'  => 'D:/Browser/phpmailer/',
    'method'     => 'folders',
    'print'      => 0,
    'display'    => 0,
    'reverse'    => 0,
    'delimiter'  => '',
    'date_start' => '',
    'date_end'   => '',
);
Directory_Lister::listing($params);

print_r('<pre>');
print_r(Directory_Lister::crawl('D:/Browser/phpmailer/'));
print_r('</pre>');
