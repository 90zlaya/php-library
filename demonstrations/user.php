<?php
/*
| -------------------------------------------------------------------
| USER
| -------------------------------------------------------------------
|
| Developing and testing User class
|
| -------------------------------------------------------------------
*/
use phplibrary\User as user;

$image = user::image(
    'background.jpg',
    'https://php-library.zlatanstajic.com/assets/img/',
    'elephpant.png'
);

echo '<img src="' . $image . '" alt="Image" />';
