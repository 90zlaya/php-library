<?php
/*
| -------------------------------------------------------------------
| GEO PLUGIN
| -------------------------------------------------------------------
|
| Developing and testing Geo_Plugin class
|
| -------------------------------------------------------------------
*/
include_once '../autoload.php';

$geo_plugin = new phplibrary\Geo_Plugin();
$geo_plugin->locate();
$data = $geo_plugin->data();

phplibrary\Format::pre($data);
