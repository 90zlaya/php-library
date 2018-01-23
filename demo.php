<?php
    echo '<h2/>';
    echo ucfirst($php_library['folders']['demonstrations']);
    echo '</h2>' . PHP_EOL;
    echo '<ol>'; 
        foreach ($php_library['list']['classes'] as $item)
        {
            echo '<li>';
            echo '<a href="view.php?page=' . $php_library['folders']['demonstrations'] . '/' . $item['name'] . '">'; 
            echo $item['name'];
            echo '</a>';
            echo '</li>' . PHP_EOL;
        }
    echo '</ol>' . PHP_EOL;
    
    echo '<h2/>';
?>