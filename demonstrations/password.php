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
use phplibrary\Password as password;

echo password::new();
echo '<br/>';
echo password::new_readable();

