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
require_once('classes/browser.php');

$user_agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:55.0) Gecko/20100101 Firefox/55.0';

print_r('<pre>');
print_r(Browser::get_list());
print_r('</pre>');

print_r('<pre>');
print_r(Browser::detect($user_agent));
print_r('</pre>');

print_r('<pre>');
print_r(Browser::is_mobile($user_agent));
print_r('</pre>');


