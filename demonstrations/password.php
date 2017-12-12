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
include_once '../autoload.php';

echo phplibrary\Password::new();
echo '<br/>';
echo phplibrary\Password::new_readable();

