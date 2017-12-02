<?php
    include_once 'autoload.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title><?=$php_library_title?></title>
</head>

<body>
<?php
    echo '<h1>Welcome to ' . $php_library_title . '</h1>'; 
    echo $php_library_description . '<br/>' . PHP_EOL;
    
    echo 'Projcet is open-sourced under MIT licence on <a href="' . $hyperlinks['php_library_on_github'] . '">GitHub</a>.&nbsp;';
    echo 'Available over <a href="https://getcomposer.org/">Composer</a> and <a href="' . $hyperlinks['php_library_on_packagist'] . '">Packagist</a>.' . PHP_EOL;
    echo '<h2/>' . ucfirst($php_library_folder_demonstrations) . '</h2>' . PHP_EOL;
    echo '<ol>' . $navigation_for_demonstration . '</ol>' . PHP_EOL;
    echo '<h2/>' . ucfirst($php_library_folder_modules) . '</h2>' . PHP_EOL;
    echo '<ol>' . $navigation_for_modules . '</ol>' . PHP_EOL;
    
    echo '<p>Copyright &#169; 2017 | <a href="https://www.zlatanstajic.com/">Zlatan Stajić</a> | Released under the <a href="http://www.opensource.org/licenses/mit-license.php" target="_target">MIT</a> License</p>' . PHP_EOL;
?>
</body>
</html>