<?php
/*
| -------------------------------------------------------------------
| OPERATING SYSTEM
| -------------------------------------------------------------------
|
| Developing and testing Operating_System class
|
| -------------------------------------------------------------------
*/
use phplibrary\Operating_System as operating_system;
use phplibrary\Format as format;

format::pre(
    operating_system::get_list()
);
