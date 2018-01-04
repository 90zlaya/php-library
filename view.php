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
    $page = isset($_GET['page']) ? $_GET['page'] . '.php' : header('Location: index.php');
    
    file_exists($page) ? include $page : header('Location: index.php');
?>
</body>
</html>