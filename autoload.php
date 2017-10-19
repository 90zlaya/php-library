<?php
/*
| -------------------------------------------------------------------
| AUTOLOAD CLASSES
| -------------------------------------------------------------------
|
| This is file where all classes are autoloaded.
| Include this file if you want all classes 
| at once in your project.
|
| -------------------------------------------------------------------
*/
$php_library_folder    = 'classes/';
$php_library_extension = '.php';
$php_library_list      = array(
    array(
        'name' => 'breadcrumbs',
    ),
    array(
        'name' => 'browser',
    ),
    array(
        'name' => 'date-time-format',
    ),
    array(
        'name' => 'directory-lister',
    ),
    array(
        'name' => 'email',
    ),
    array(
        'name' => 'file',
    ),
    array(
        'name' => 'format',
    ),
    array(
        'name' => 'operating-system',
    ),
    array(
        'name' => 'pagination',
    ),
    array(
        'name' => 'password',
    ),
    array(
        'name' => 'random',
    ),
    array(
        'name' => 'temperature',
    ),
    array(
        'name' => 'user',
    ),
    array(
        'name' => 'validation',
    ),
    array(
        'name' => 'web-service',
    ),
    array(
        'name' => 'website',
    ),
);

foreach($php_library_list as $item)
{
    $name = $item['name'];
    
    require_once $php_library_folder . $name . $php_library_extension;
}
