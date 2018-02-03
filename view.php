<?php
    include_once 'autoload.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" href="<?=$php_library['hyperlinks']['images']['icon']?>" type="image/png">
    <title><?=$php_library['meta']['title']?></title>
    <meta content="<?=$php_library['meta']['title']?>" property="og:title">
    <meta content="<?=$php_library['meta']['description']?>" name="description">
</head>

<body>
<?php
    $home_page = 'index.php';
    
    $location = isset($_GET['page']) 
        ? $_GET['page'] 
        : header('Location: ' . $home_page);
        
    $page = $location . '.php';

    if (file_exists($page))
    {
        include $page;
    }
    else
    {
        $special_location = $location . '/' . $home_page;
        
        if (file_exists($special_location))
        {
            include $special_location;
        }
        else
        {
            switch ($location)
            {
                case 'demo': 
                {
                    echo '<h2/>';
                    echo ucfirst($php_library['folders']['demonstrations']);
                    echo '</h2>' . PHP_EOL;
                    echo '<ol>'; 
                        foreach ($php_library['list']['classes'] as $item)
                        {
                            echo '<li>';
                            echo '<a href="view.php?page=';
                            echo $php_library['folders']['demonstrations'];
                            echo '/';
                            echo $item['name'];
                            echo '">'; 
                            echo $item['name'];
                            echo '</a>';
                            echo '</li>';
                            echo PHP_EOL;
                        }
                    echo '</ol>' . PHP_EOL;
                    
                    echo '<h2/>';
                    
                    break;
                }
                case 'log':
                {
                    $fh = fopen('log.txt', 'r');
                    
                    do
                    {
                        $line = fgets($fh);
                        
                        echo $line . '<br>';
                    }
                    while ($line);
                    
                    fclose($fh);
                    
                    break;
                }
                default: header('Location: ' . $home_page);
            }
        }
    }
?>
</body>
</html>
