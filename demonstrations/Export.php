<?php
/*
| -------------------------------------------------------------------
| EXPORT
| -------------------------------------------------------------------
|
| Developing and testing Export class
|
| -------------------------------------------------------------------
*/
use phplibrary\Format as format;
use phplibrary\Export as export;

$head = array(
    'Title1',
    'Title2',
);

$data = array(
    array(
        'title1' => 'Value11',
        'title2' => 'Value12',
    ),
    array(
        'title1' => 'Value21',
        'title2' => 'Value22',
    ),
    array(
        'title1' => 'Value31',
        'title2' => 'Value32',
    ),
);

$data = array();

$params = array(
    'head' => $head, 
    'data' => $data, 
    'type' => 'xlsx',
);

echo '<a href="#" onclick="">Export</a>';

format::pre(export::allowed_types());
