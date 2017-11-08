<?php
/*
| -------------------------------------------------------------------
| AUTOLOAD
| -------------------------------------------------------------------
|
| This is file where all classes are autoloaded.
| This file also contains global data for some pages.
| 
| Include this file if you want all classes 
| at once in your project.
|
| -------------------------------------------------------------------
*/
$git_hub_username                  = '90zlaya';
$php_library_title                 = 'PHP Library';
$php_library_name                  = 'php-library';
$php_library_description           = 'PHP Library is set of classes containing most useful methods and variables for Web Development.';
$php_library_namespace             = 'phplibrary';

$php_library_folder_classes        = 'classes';
$php_library_folder_demonstrations = 'demonstrations';
$php_library_folder_modules        = 'modules';

$php_library_extension             = '.php';

$php_library_list_of_classes       = array(
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
        'name' => 'geo-plugin',
    ),
    array(
        'name' => 'math',
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
$php_library_list_of_modules       = array(
    array(
        'name' => 'file-version',
    ),
    array(
        'name' => 'spider',
    ),
);

$hyperlinks                        = array(
    'php_library_on_github'     => 'https://github.com/90zlaya/php-library',
    'php_library_on_packagist'  => 'https://packagist.org/packages/90zlaya/php-library',
);

$navigation_for_demonstration = '';
foreach($php_library_list_of_classes as $item)
{
    $name = $item['name'];
    
    require_once $php_library_folder_classes . '/' . $name . $php_library_extension;
    
    $navigation_for_demonstration .= '<li><a href="' . $php_library_folder_demonstrations . '/' . $name . $php_library_extension . '">' . $name . '</a></li>' . PHP_EOL;
}

$navigation_for_modules = '';
foreach($php_library_list_of_modules as $item)
{
    $name = $item['name'];
    
    $navigation_for_modules .= '<li><a href="' . $php_library_folder_modules . '/' . $name . '">' . $name . '</a></li>' . PHP_EOL;
}
