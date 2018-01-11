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
$geo_plugin->locate();

if ($geo_plugin->is_active_service())
{
    echo 'Active service, all data returned.<br/>';
}
else
{
    echo 'Inactive service, only base data returned.<br/>';
}
    
format::pre($geo_plugin->data(), 0);
