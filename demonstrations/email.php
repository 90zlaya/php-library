<?php
/*
| -------------------------------------------------------------------
| EMAIL
| -------------------------------------------------------------------
|
| Developing and testing Email class
|
| -------------------------------------------------------------------
*/
include_once '../autoload.php';

$email = 'zlatan.stajic@guerrillamail.com';
$mailto = phplibrary\Email::mailto($email);
echo $mailto . '<br/>' . phplibrary\Email::validate($email);
