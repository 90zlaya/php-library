<?php
/*
| -------------------------------------------------------------------
| SORTER
| -------------------------------------------------------------------
|
| Developing and testing Sorter class
|
| -------------------------------------------------------------------
*/
include_once '../autoload.php';

$sorter = new phplibrary\Sorter();
$report = $sorter->deploy(array(
    'where_to_read_files'           => 'D:/Browser/sorter/source/',
    'where_to_create_directories'   => 'D:/Browser/sorter/destination/',
    'folder_sufix'                  => '000',
    'number_of_directories'         => 10,
    'operation'                     => 'c',
    'types'                         => array('jpg'),
));

echo $report['string'];
phplibrary\Format::pre($report['array'], TRUE);
