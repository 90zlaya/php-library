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
include_once '../autoload.php';

$image = phplibrary\User::image('background.jpg', '../assets/img/', 'elephpant.png');

echo '<img src="' . $image . '" alt="Image" />';
