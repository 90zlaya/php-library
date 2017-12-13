<?php
    include_once 'autoload.php';
?>
<!doctype html>
<html>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" href="<?=$hyperlinks['images']['icon']?>" type="image/png">
    <title><?=$php_library_title?></title>
    <meta content="<?=$php_library_title?>" property="og:title">
    <meta content="<?=$php_library_description?>" name="description">

    <!-- jQuery Load -->
    <script src="assets/js/jquery.min.js"></script>

    <!-- Flatdoc -->
    <script src='assets/js/legacy.js'></script>
    <script src='assets/js/flatdoc.js'></script>

    <!-- Flatdoc theme -->
    <link  href='assets/css/style.css' rel='stylesheet'>
    <script src='assets/js/script.js'></script>

    <link href='assets/css/theme.css' rel='stylesheet'>
    <script src='assets/js/theme.js'></script>
    
    <!-- Initializer -->
    <script>
    Flatdoc.run({
      fetcher: Flatdoc.github('<?=$git_hub_username . '/' . $php_library_name?>')
    });
    </script>
</head>

<body role='flatdoc' class='big-h3 large-brief'>
    <!-- TITLE -->
    <div class='title-area title-card' style='background-image: url(<?=$hyperlinks['images']['background']?>);'>
        <div class='in'>
            <div class='headline'>
                <h1><?=$php_library_title?></h1>
                <p><?=$php_library_description_short?></p>
                <h5>
                    <?php
                        foreach ($hyperlinks['buttons'] as $button)
                        {
                            echo '<span onclick="window.location=\'' . $button['url'] . '\';" style="cursor: pointer;">' . $button['name'] . '</span>&nbsp;';
                        }
                    ?>
                </h5>
            </div>
        </div>
    </div>
    <!-- HEADER -->
    <div class='header'>
        <div class='left'>
            <h1><?=$php_library_title?></h1>
            <ul>
              <?php
                  foreach ($hyperlinks['php_library'] as $php_library)
                  {
                      echo '<li><a href="' . $php_library['url'] . '" target="_blank">' . $php_library['name'] . '</a></li>';
                  }
              ?>
            </ul>
        </div>
    </div>
    <!-- CONTENT -->
    <div class='content-root'>
        <div class='menubar'>
            <div class="section">
                <a class="big button" href="<?=$hyperlinks['url']['latest_release']?>" target="_blank">Download</a>
            </div>
            <div class='menu section' role='flatdoc-menu'></div>
        </div>
        <div role='flatdoc-content' class='content'></div>
    </div>
</body>
</html>