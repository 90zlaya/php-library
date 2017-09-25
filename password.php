<?php
/*
| -------------------------------------------------------------------
| PASSWORD
| -------------------------------------------------------------------
|
| Developing and testing Password class
|
| -------------------------------------------------------------------
*/
require_once('classes/password.php');

$string = 'password';
echo Password::strength($string, FALSE);

echo '<br/>';

echo ctype_alnum($string);