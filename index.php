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
    <!-- jQuery Load -->
    <script src="https://php-library.zlatanstajic.com/assets/js/jquery.min.js"></script>
    <!-- Flatdoc -->
    <script src="https://php-library.zlatanstajic.com/assets/js/legacy.js"></script>
    <script src="https://php-library.zlatanstajic.com/assets/js/flatdoc.js"></script>
    <!-- Flatdoc theme -->
    <link  href="https://php-library.zlatanstajic.com/assets/css/style.css" rel="stylesheet">
    <script src="https://php-library.zlatanstajic.com/assets/js/script.js"></script>
    <link href="https://php-library.zlatanstajic.com/assets/css/theme.css" rel="stylesheet">
    <script src="https://php-library.zlatanstajic.com/assets/js/theme.js"></script>
    <!-- Custom PHP Library style -->
    <link href="https://php-library.zlatanstajic.com/assets/css/custom.css" rel="stylesheet">
    <!-- Initializer -->
    <script>
        Flatdoc.run({
            fetcher: Flatdoc.github('90zlaya/php-library')
        });
    </script>
</head>

<body role="flatdoc" class="big-h3 large-brief">
    <!-- TITLE -->
    <div class="title-area title-card title-image">
        <div class="in">
            <div class="headline">
                <h1><?=$php_library['meta']['title']?></h1>
                <p><?=$php_library['meta']['tagline']?></p>
                <h5>
                    <?php
                        $api_directories = array(
                            'api',
                            'output',
                        );
                        
                        foreach ($php_library['hyperlinks']['buttons'] as $button)
                        {
                            echo '<span onclick="';
                            
                            if ($button['method'] == '_blank')
                            {
                                foreach ($api_directories as $directory)
                                {
                                    if (is_dir($directory))
                                    {
                                        $button['url'] = $directory;
                                        
                                        break;
                                    }
                                }
                                
                                echo 'window.open(\'';
                                echo $button['url'];
                                echo '\', \'';
                                echo $button['method'];
                                echo '\')';
                            }
                            else
                            {
                                echo 'window.location=\'';
                                echo $button['url'];
                                echo '\'';
                            }
                            
                            echo ';" class="main-button" role="button">';
                            echo $button['name'];
                            echo '</span>&nbsp;';
                        }
                    ?>
                </h5>
            </div>
        </div>
    </div>
    <!-- HEADER -->
    <div class="header">
        <div class="left">
            <h1><?=$php_library['meta']['title']?></h1>
            <ul>
                <?php
                    foreach ($php_library['hyperlinks']['php_library'] as $link)
                    {
                        echo '<li><a href="';
                        echo $link['url'];
                        echo '" target="_blank">';
                        echo $link['name'];
                        echo '</a></li>';
                    }
                ?>
            </ul>
        </div>
    </div>
    <!-- CONTENT -->
    <div class="content-root">
        <div class="menubar">
            <div class="section">
                <a class="big button" href="<?=$php_library['hyperlinks']['url']['latest_release']?>" target="_blank">Download</a>
            </div>
            <div class="menu section" role="flatdoc-menu"></div>
        </div>
        <div role="flatdoc-content" class="content"></div>
    </div>
</body>

</html>
