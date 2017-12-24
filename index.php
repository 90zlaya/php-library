<?php
    include_once 'autoload.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" href="<?=$php_library['hyperlinks']['images']['icon']?>" type="image/png">
    <title><?=$php_library['meta']['title']?></title>
    <meta content="<?=$php_library['meta']['title']?>" property="og:title">
    <meta content="<?=$php_library['meta']['description']?>" name="description">
    <!-- jQuery Load -->
    <script src="assets/js/jquery.min.js"></script>
    <!-- Flatdoc -->
    <script src="assets/js/legacy.js"></script>
    <script src="assets/js/flatdoc.js"></script>
    <!-- Flatdoc theme -->
    <link  href="assets/css/style.css" rel='stylesheet'>
    <script src="assets/js/script.js"></script>
    <link href="assets/css/theme.css" rel='stylesheet'>
    <script src="assets/js/theme.js"></script>
    <!-- Custom PHP Library style -->
	<link href="assets/css/custom.css" rel='stylesheet'>
    <!-- Initializer -->
    <script>
    Flatdoc.run({
        fetcher: Flatdoc.github('90zlaya/php-library')
    });
    </script>
</head>

<body role='flatdoc' class='big-h3 large-brief'>
    <!-- TITLE -->
    <div class='title-area title-card title-image'>
        <div class='in'>
            <div class='headline'>
                <h1><?=$php_library['meta']['title']?></h1>
                <p><?=$php_library['meta']['tagline']?></p>
                <h5>
                    <?php
                        foreach ($php_library['hyperlinks']['buttons'] as $button)
                        {
                            echo '<span onclick="window.location=\'' . $button['url'] . '\';" class="main-button" role="button">' . $button['name'] . '</span>&nbsp;';
                        }
                    ?>
                </h5>
            </div>
        </div>
    </div>
    <!-- HEADER -->
    <div class='header'>
        <div class='left'>
            <h1><?=$php_library['meta']['title']?></h1>
            <ul>
              <?php
                  foreach ($php_library['hyperlinks']['php_library'] as $link)
                  {
                      echo '<li><a href="' . $link['url'] . '" target="_blank">' . $link['name'] . '</a></li>';
                  }
              ?>
            </ul>
        </div>
    </div>
    <!-- CONTENT -->
    <div class='content-root'>
        <div class='menubar'>
            <div class="section">
                <a class="big button" href="<?=$php_library['hyperlinks']['url']['latest_release']?>" target="_blank">Download</a>
            </div>
            <div class='menu section' role='flatdoc-menu'></div>
        </div>
        <div role='flatdoc-content' class='content'></div>
    </div>
</body>
</html>