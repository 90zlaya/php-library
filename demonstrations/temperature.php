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
include_once '../autoload.php';

$value = 300.7;

$k_to_c = phplibrary\Temperature::k_to_c($value);
$k_to_f = phplibrary\Temperature::k_to_f($value);
$f_to_c = phplibrary\Temperature::f_to_c($k_to_f['value']);
$f_to_k = phplibrary\Temperature::f_to_k($k_to_f['value']);
$c_to_f = phplibrary\Temperature::c_to_f($f_to_c['value']);
$c_to_k = phplibrary\Temperature::c_to_k($f_to_c['value']);

echo $value . ' K is ' . $k_to_c['sign'] . '<br/>';
echo $value . ' K is ' . $k_to_f['sign'] . '<br/>';
echo '<br/>';
echo $k_to_f['sign'] . ' is ' . $f_to_c['sign'] . '<br/>';
echo $k_to_f['sign'] . ' is ' . $f_to_k['sign'] . '<br/>';
echo '<br/>';
echo $f_to_c['sign'] . ' is ' . $c_to_f['sign'] . '<br/>';
echo $f_to_c['sign'] . ' is ' . $c_to_k['sign'] . '<br/>';
