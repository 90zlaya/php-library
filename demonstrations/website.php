<?php
/*
| -------------------------------------------------------------------
| WEBSITE
| -------------------------------------------------------------------
|
| Developing and testing Website class
|
| -------------------------------------------------------------------
*/
include_once '../autoload.php';

// Instance of Website class
$website = new phplibrary\Website(
    array(
        'name'          => 'PHP Library',
        'host'          => 'http://localhost/_develop/php-library/',
        'made'          => '2017',
        'language'      => 'EN',
        'description'   => 'PHP Library is set of classes containing most useful methods and variables for Web Development.',
        'keywords'      => 'php, library, oop, php7',
    )
);

// Adding parameters to head
$website->add_to_head(
    array(
        array(
            'path' => 'custom.css',
            'type' => 'link',
        ),
        array(
            'path' => 'body {background-color: powderblue;}',
            'type' => 'link-custom',
        ),
        array(
            'path' => 'https://code.jquery.com/jquery-3.2.1.min.js',
            'type' => 'script',
        ),
        array(
            'path' => 'alert("head custom script loaded");',
            'type' => 'script-custom',
        ),
    )
);

// Adding parameters to bottom
$website->add_to_bottom(
    array(
        array(
            'path' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',
            'type' => 'script',
        ),
        array(
            'path' => 'alert("bottom custom script loaded");',
            'type' => 'script-custom',
        ),
    )
);

// Adding images to website
$website->add_to_images(
    array(
        'php-logo' => 'http://thedeveloperworldisyours.com/wp-content/uploads/php.png',
    ),
    TRUE
);

?>
<!doctype html>
<html>
<head>
    <?php
        // Printing meta
        echo $website->meta(array(
            'shortcut_icon' => $website->images('php-logo'),
            'touch_icon'    => $website->images('php-logo'),
        ));
        
        // Printing head
        echo $website->head();
    ?>
</head>

<body>
    <div>
        <h1>Welcome to the <?=$website->name;?></h1>
        <img src="<?=$website->images('php-logo');?>">
    </div>
    <?php
        // Redirection
        //$website->redirect_to_page('https://www.google.com/', TRUE);
        
        // Printing bottom
        echo $website->bottom();
        
        // Creator signature
        echo $website->signature();
        
        // Creator signature for html source
        echo $website->signature_hidden();
    ?>
</body>

</html>