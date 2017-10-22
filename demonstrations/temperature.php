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

$k_to_c = Temperature::k_to_c($value);
$k_to_f = Temperature::k_to_f($value);
$f_to_c = Temperature::f_to_c($k_to_f['value']);
$f_to_k = Temperature::f_to_k($k_to_f['value']);

echo $value . ' K is ' . $k_to_c['sign'] . '<br/>';
echo $value . ' K is ' . $k_to_f['sign'] . '<br/>';
echo '<br/>';
echo $k_to_f['sign'] . ' is ' . $f_to_c['sign'] . '<br/>';
echo $k_to_f['sign'] . ' is ' . $f_to_k['sign'] . '<br/>';
