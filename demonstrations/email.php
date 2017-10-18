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
require_once('../classes/email.php');

$email = 'zlatan.stajic@guerrillamail.com';
$mailto = Email::mailto($email);
echo $mailto . '<br/>' . Email::validate($email);
