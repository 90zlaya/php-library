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

$directory = 'D:/Browser/images/';
$files = Directory_Lister::files($directory);
print_r('<pre>');
print_r($files);
print_r('</pre>');

$delimiter = '1457618897445-1042036105';
$search = Directory_Lister::search($files, $delimiter);
print_r('<pre>');
print_r($search);
print_r('</pre>');

/*
$mime_types = array(
    'png',
    'jpg',
);
$items = Directory_Lister::display($search, $mime_types);
foreach($items as $item)
{
    echo $item;
}
*/    