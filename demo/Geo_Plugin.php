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
use phplibrary\Geo_Plugin as geo_plugin;
use phplibrary\Format as format;

$geo_plugin = new geo_plugin();    
format::pre($geo_plugin->data()['base'], TRUE);
