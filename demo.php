<?php
    echo '<h2/>';
    echo ucfirst($php_library['folders']['demonstrations']);
    echo '</h2>' . PHP_EOL;
    echo '<ol>'; 
        foreach ($php_library['list']['classes'] as $item)
        {
            echo '<li>';
            //echo '<a href="' . $php_library['folders']['demonstrations'] . DIRECTORY_SEPARATOR . $item['name'] . '.php' . '">'; 
            echo '<a href="view.php?page=' . $php_library['folders']['demonstrations'] . '/' . $item['name'] . '">'; 
            echo $item['name'];
            echo '</a>';
            echo '</li>' . PHP_EOL;
        }
    echo '</ol>' . PHP_EOL;
    
    echo '<h2/>';
    echo ucfirst($php_library['folders']['modules']);
    echo '</h2>' . PHP_EOL;
    echo '<ol>';
        foreach ($php_library['list']['modules'] as $item)
        {
            echo '<li>';
            echo '<a href="' . $php_library['folders']['modules'] . '/' . $item['name'] . '">';
            echo $item['name'];
            echo '</a>';
            echo '</li>' . PHP_EOL;
        }    
    echo '</ol>' . PHP_EOL;
?>