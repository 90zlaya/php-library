<?php
    include_once 'autoload.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
    <title><?=$php_library_title?></title>
    <link rel="shortcut icon" href="<?=$hyperlinks['images']['icon']?>" type="image/png">
</head>

<body>
<?php
    echo '<h1>Welcome to ' . $php_library_title . '</h1>'; 
    echo $php_library_description . '<br/>' . PHP_EOL;
    
    echo 'Projcet is open-sourced under MIT licence on <a href="' . $hyperlinks['php_library']['on_github']['url'] . '" target="_blank">GitHub</a>.&nbsp;';
    echo 'Available over <a href="https://getcomposer.org/" target="_blank">Composer</a> and <a href="' . $hyperlinks['php_library']['on_packagist']['url'] . '" target="_blank">Packagist</a>.' . PHP_EOL;
    echo '<h2/>' . ucfirst($php_library_folder_demonstrations) . '</h2>' . PHP_EOL;
    echo '<ol>' . $navigation_for_demonstration . '</ol>' . PHP_EOL;
    echo '<h2/>' . ucfirst($php_library_folder_modules) . '</h2>' . PHP_EOL;
    echo '<ol>' . $navigation_for_modules . '</ol>' . PHP_EOL;
    
    echo '<p>Copyright &#169; 2017 | <a href="https://www.zlatanstajic.com/">Zlatan Stajić</a> | Released under the <a href="http://www.opensource.org/licenses/mit-license.php" target="_target">MIT</a> License</p>' . PHP_EOL;
?>
</body>
</html>