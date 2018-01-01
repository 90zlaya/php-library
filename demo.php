<?php
    include_once 'autoload.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
    <title><?=$php_library['meta']['title']?></title>
    <link rel="shortcut icon" href="<?=$php_library['hyperlinks']['images']['icon']?>" type="image/png">
</head>

<body>
<?php
    echo '<h1>Welcome to ' . $php_library['meta']['title'] . '</h1>'; 
    echo $php_library['meta']['description'] . '<br/>' . PHP_EOL;
    
    echo 'Projcet is open-sourced under MIT licence on <a href="' . $php_library['hyperlinks']['php_library']['on_github']['url'] . '" target="_blank">GitHub</a>.&nbsp;';
    echo 'Available over <a href="https://getcomposer.org/" target="_blank">Composer</a> and <a href="' . $php_library['hyperlinks']['php_library']['on_packagist']['url'] . '" target="_blank">Packagist</a>.' . PHP_EOL;
    
    echo '<h2/>' . ucfirst($php_library['folders']['demonstrations']) . '</h2>' . PHP_EOL;
    echo '<ol>'; 
        foreach ($php_library['list']['classes'] as $item)
        {
            echo '<li>';
            echo '<a href="' . $php_library['folders']['demonstrations'] . DIRECTORY_SEPARATOR . $item['name'] . '.php' . '">'; 
            echo $item['name'];
            echo '</a>';
            echo '</li>' . PHP_EOL;
        }
    echo '</ol>' . PHP_EOL;
    
    echo '<h2/>' . ucfirst($php_library['folders']['modules']) . '</h2>' . PHP_EOL;
    echo '<ol>';
        foreach ($php_library['list']['modules'] as $item)
        {
            echo '<li>';
            echo '<a href="' . $php_library['folders']['modules'] . DIRECTORY_SEPARATOR . $item['name'] . '">';
            echo $item['name'];
            echo '</a>';
            echo '</li>' . PHP_EOL;
        }    
    echo '</ol>' . PHP_EOL;
    
    echo '<p>Copyright &#169; 2017-2018 | <a href="https://www.zlatanstajic.com/">Zlatan Stajić</a> | Released under the <a href="http://www.opensource.org/licenses/mit-license.php" target="_target">MIT</a> License</p>' . PHP_EOL;
?>
</body>
</html>