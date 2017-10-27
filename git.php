<?php
    include_once 'autoload.php';
?>
<!doctype html>
<html>
<head>
  <meta charset='utf-8'>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width">

  <title><?php echo $php_library_title; ?></title>

  <!-- Flatdoc -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src='https://cdn.rawgit.com/rstacruz/flatdoc/v0.9.0/legacy.js'></script>
  <script src='https://cdn.rawgit.com/rstacruz/flatdoc/v0.9.0/flatdoc.js'></script>

  <!-- Flatdoc theme -->
  <link  href='https://cdn.rawgit.com/rstacruz/flatdoc/v0.9.0/theme-white/style.css' rel='stylesheet'>
  <script src='https://cdn.rawgit.com/rstacruz/flatdoc/v0.9.0/theme-white/script.js'></script>

  <!-- Meta -->
  <meta content="<?php echo $php_library_title; ?>" property="og:title">
  <meta content="<?php echo $php_library_description; ?>" name="description">

  <!-- Initializer -->
  <script>
    Flatdoc.run({
      fetcher: Flatdoc.github('<?php echo $git_hub_username . '/' . $php_library_name; ?>')
    });
  </script>
</head>
<body role='flatdoc'>
  <!-- HEADER -->
  <div class='header'>
    <div class='left'>
      <h1><?php echo $php_library_title; ?></h1>
      <ul>
        <li><a href='<?php echo $hyperlinks['php_library_on_github']; ?>'>View on GitHub</a></li>
        <li><a href='<?php echo $hyperlinks['php_library_on_packagist']; ?>'>View on Packagist</a></li>
        <li><a href='<?php echo $hyperlinks['php_library_on_github']; ?>/issues'>Issues</a></li>
      </ul>
    </div>
    <div class='right'>
      <!-- GitHub buttons: see http://ghbtns.com -->
      <iframe src="http://ghbtns.com/github-btn.html?user=<?php echo $git_hub_username; ?>&amp;repo=<?php echo $php_library_name; ?>&amp;type=watch&amp;count=true" allowtransparency="true" frameborder="0" scrolling="0" width="110" height="20"></iframe>
    </div>
  </div>
  <!-- /HEADER -->
  <!-- CONTENT -->
  <div class='content-root'>
    <div class='menubar'>
      <div class='menu section' role='flatdoc-menu'></div>
    </div>
    <div role='flatdoc-content' class='content'></div>
  </div>
  <!-- /CONTENT -->
</body>
</html>
