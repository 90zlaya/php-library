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
use phplibrary\Sorter as sorter;
use phplibrary\Format as format;

$sorter = new sorter();
$report = $sorter->deploy(array(
    'where_to_read_files'           => 'D:/Browser/sorter/source/',
    'where_to_create_directories'   => 'D:/Browser/sorter/destination/',
    'folder_sufix'                  => '000',
    'number_of_directories'         => 10,
    'operation'                     => 'c',
    'types'                         => array('jpg'),
));

echo $report['string'];
format::pre($report['array'], TRUE);
