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

echo Password::new();
echo '<br/>';
echo Password::new_readable();

