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
require_once('../classes/password.php');

echo Password::new();
echo '<br/>';
echo Password::new_readable();

