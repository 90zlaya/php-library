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
$php_library = array(
    'meta'          => array(
        'title'         => 'PHP Library',
        'description'   => 'PHP Library is set of classes containing most useful methods and variables for Web Development.',
        'tagline'       => 'Set of classes containing most useful methods and variables for Web Development',
    ),
    'folders'       => array(
        'classes'           => 'classes',
        'demonstrations'    => 'demonstrations',
    ),
    'list'          => array(
        'classes' => array(
            array(
                'name' => 'Date_Time_Format',
            ),
            array(
                'name' => 'Directory_Lister',
            ),
            array(
                'name' => 'Email',
            ),
            array(
                'name' => 'Export',
            ),
            array(
                'name' => 'File',
            ),
            array(
                'name' => 'File_Version',
            ),
            array(
                'name' => 'Format',
            ),
            array(
                'name' => 'Geo_Plugin',
            ),
            array(
                'name' => 'Math',
            ),
            array(
                'name' => 'Operating_System',
            ),
            array(
                'name' => 'Password',
            ),
            array(
                'name' => 'Random',
            ),
            array(
                'name' => 'Sorter',
            ),
            array(
                'name' => 'Temperature',
            ),
            array(
                'name' => 'User',
            ),
            array(
                'name' => 'User_Agent',
            ),
            array(
                'name' => 'Validation',
            ),
            array(
                'name' => 'Web_Service',
            ),
            array(
                'name' => 'Website',
            ),
        ),
    ),
    'hyperlinks'    => array(
        'php_library'   => array(
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
        'buttons'       => array(
            array(
                'name'   => 'Demo',
                'url'    => 'view.php?page=demo',
                'method' => '',
            ),
            array(
                'name'   => 'Log',
                'url'    => 'view.php?page=log',
                'method' => '',
            ),
            array(
                'name'   => 'API',
                'url'    => 'https://php-library.zlatanstajic.com/api/',
                'method' => '_blank',
            ),
        ),
        'images'        => array(
            'icon'       => 'https://php-library.zlatanstajic.com/assets/img/elephpant.png',
        ),
        'url'           => array(
            'latest_release' => 'https://github.com/90zlaya/php-library/releases/latest',
        ),
    ),
);

foreach ($php_library['list']['classes'] as $item)
{
    $file_location  = $php_library['folders']['classes'];
    $file_location .= '/';
    $file_location .= $item['name'];
    $file_location .= '.php';
    
    require_once $file_location;
}
