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
        'modules'           => 'modules',
    ),
    'list'          => array(
        'classes' => array(
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
                'name' => 'sorter',
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
        ),
        'modules' => array(
            array(
                'name' => 'file-version',
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
                'name'  => 'Demo',
                'url'   => 'view.php?page=demo',
            ),
            array(
                'name'  => 'Log',
                'url'   => 'view.php?page=log',
            ),
        ),
        'images'        => array(
            'icon'       => 'assets/img/elephpant.png',
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
