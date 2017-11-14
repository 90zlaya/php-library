<?php
/*
| -------------------------------------------------------------------
| BROWSER
| -------------------------------------------------------------------
|
| Developing and testing Browser class
|
| -------------------------------------------------------------------
*/
include_once '../autoload.php';

$user_agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:55.0) Gecko/20100101 Firefox/55.0';

phplibrary\Format::pre(phplibrary\Browser::get_list());
phplibrary\Format::pre(phplibrary\Browser::detect($user_agent));
phplibrary\Format::pre(phplibrary\Browser::is_mobile($user_agent));
