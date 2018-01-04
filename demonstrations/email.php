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
use phplibrary\Email as email;

$email = 'zlatan.stajic@guerrillamail.com';
$mailto = email::mailto($email);
echo $mailto . '<br/>' . email::validate($email);
