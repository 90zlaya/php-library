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
use phplibrary\Format as format;

$string = 'T3stPa$$w0r6';

format::pre(password::new());
format::pre(password::new_readable());
format::pre(password::strength($string, FALSE, 80));
format::pre(password::encode($string));
format::pre(password::decode($string));
