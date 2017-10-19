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
$mailto = Email::mailto($email);
echo $mailto . '<br/>' . Email::validate($email);
