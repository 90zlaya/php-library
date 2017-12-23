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

use phplibrary\Password as password;

echo password::new();
echo '<br/>';
echo password::new_readable();

