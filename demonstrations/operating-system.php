<?php
/*
| -------------------------------------------------------------------
| OPERATING SYSTEM
| -------------------------------------------------------------------
|
| Developing and testing Operating System class
|
| -------------------------------------------------------------------
*/
include_once '../autoload.php';

use phplibrary\Operating_System as operating_system;
use phplibrary\Format as format;

format::pre(
    operating_system::get_list()
);
