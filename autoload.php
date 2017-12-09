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
$git_hub_username                   = '90zlaya';
$php_library_title                  = 'PHP Library';
$php_library_name                   = 'php-library';
$php_library_description            = 'PHP Library is set of classes containing most useful methods and variables for Web Development.';
$php_library_description_short      = 'Set of classes containing most useful methods and variables for Web Development';
$php_library_namespace              = 'phplibrary';

$php_library_folder_classes         = 'classes';
$php_library_folder_demonstrations  = 'demonstrations';
$php_library_folder_modules         = 'modules';

$php_library_list_of_classes        = array(
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
        'name' => 'export',
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
        'name' => 'user-agent',
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
$php_library_list_of_modules        = array(
    array(
        'name' => 'file-version',
    ),
    array(
        'name' => 'image-sorter',
    ),
    array(
        'name' => 'spider',
    ),
);
$hyperlinks                         = array(
    'php_library' => array(
        'on_github'     => array(
            'name'  => 'View on GitHub',
            'url'   => 'https://github.com/90zlaya/php-library',
        ),
        'on_packagist'  => array(
            'name'  => 'View on Packagist',
            'url'   => 'https://packagist.org/packages/90zlaya/php-library',
        ),
        'issues'        => array(
            'name'  => 'Issues',
            'url'   => 'https://github.com/90zlaya/php-library/issues',
        ),
    ),
    'buttons' => array(
        array(
            'name'  => 'Demo',
            'url'   => 'demo.php',
        ),
        array(
            'name'  => 'Log',
            'url'   => 'log.txt',
        ),
    ),
    'images'  => array(
        'icon'       => 'http://thedeveloperworldisyours.com/wp-content/uploads/php.png',
        'background' => 'background.jpg',
    ),
    'url'     => array(
        'latest_release' => 'https://github.com/90zlaya/php-library/releases/latest',
    ),
);

$navigation_for_demonstration = $navigation_for_modules = '';

foreach ($php_library_list_of_classes as $item)
{
    require_once $php_library_folder_classes . DIRECTORY_SEPARATOR . $item['name'] . '.php';
    
    $navigation_for_demonstration .= '<li>';
    $navigation_for_demonstration .= '<a href="' . $php_library_folder_demonstrations . DIRECTORY_SEPARATOR . $item['name'] . '.php' . '">'; 
    $navigation_for_demonstration .= $item['name'];
    $navigation_for_demonstration .= '</a>';
    $navigation_for_demonstration .= '</li>' . PHP_EOL;
}

foreach ($php_library_list_of_modules as $item)
{
    $navigation_for_modules .= '<li>';
    $navigation_for_modules .= '<a href="' . $php_library_folder_modules . DIRECTORY_SEPARATOR . $item['name'] . '">';
    $navigation_for_modules .= $item['name'];
    $navigation_for_modules .= '</a>';
    $navigation_for_modules .= '</li>' . PHP_EOL;
}
