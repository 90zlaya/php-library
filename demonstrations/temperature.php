<?php
/*
| -------------------------------------------------------------------
| TEMPERATURE
| -------------------------------------------------------------------
|
| Developing and testing Temperature class
|
| -------------------------------------------------------------------
*/
use phplibrary\Temperature as temperature;

$value = 300.7;

$k_to_c = temperature::k_to_c($value);
$k_to_f = temperature::k_to_f($value);
$f_to_c = temperature::f_to_c($k_to_f['value']);
$f_to_k = temperature::f_to_k($k_to_f['value']);
$c_to_f = temperature::c_to_f($f_to_c['value']);
$c_to_k = temperature::c_to_k($f_to_c['value']);

echo $value . ' K is ' . $k_to_c['sign'] . '<br/>';
echo $value . ' K is ' . $k_to_f['sign'] . '<br/>';
echo '<br/>';
echo $k_to_f['sign'] . ' is ' . $f_to_c['sign'] . '<br/>';
echo $k_to_f['sign'] . ' is ' . $f_to_k['sign'] . '<br/>';
echo '<br/>';
echo $f_to_c['sign'] . ' is ' . $c_to_f['sign'] . '<br/>';
echo $f_to_c['sign'] . ' is ' . $c_to_k['sign'] . '<br/>';
